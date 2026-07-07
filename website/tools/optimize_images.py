#!/usr/bin/env python3
"""
图片优化脚本 — 转换为 WebP + 压缩 PNG/JPG
用于 website/preview/images/ 目录

用法:
    python optimize_images.py                    # 转换全部图片
    python optimize_images.py --quality 85       # 自定义质量
    python optimize_images.py --dry-run          # 预览不执行
    python optimize_images.py --resize 1200      # 限制最大宽度

依赖: pip install Pillow
"""

import os
import sys
import argparse
from pathlib import Path

try:
    from PIL import Image
except ImportError:
    print("Error: Pillow not installed. Run: pip install Pillow")
    sys.exit(1)

IMAGES_DIR = Path(__file__).parent.parent / "preview" / "images"


def optimize_image(filepath, quality=80, max_width=None, dry_run=False):
    """Convert image to WebP, return size stats."""
    original_size = os.path.getsize(filepath)
    ext = filepath.suffix.lower()

    try:
        img = Image.open(filepath)

        # Resize if needed
        if max_width and img.width > max_width:
            ratio = max_width / img.width
            new_size = (max_width, int(img.height * ratio))
            img = img.resize(new_size, Image.LANCZOS)

        # Convert to WebP
        webp_path = filepath.with_suffix('.webp')
        if not dry_run:
            # Always produce a WebP version
            img.save(webp_path, 'WEBP', quality=quality)

            # For PNG originals, also compress the original
            if ext == '.png':
                img.save(filepath, 'PNG', optimize=True)

            # For JPG originals, also compress
            if ext in ('.jpg', '.jpeg'):
                img.save(filepath, 'JPEG', quality=quality, optimize=True)

            new_size = os.path.getsize(webp_path)
            reduction = (1 - new_size / original_size) * 100
            return {
                'file': filepath.name,
                'original_kb': original_size / 1024,
                'webp_kb': new_size / 1024,
                'saved_pct': reduction,
            }
        else:
            return {
                'file': filepath.name,
                'original_kb': original_size / 1024,
                'webp_kb': 0,
                'saved_pct': 0,
            }

    except Exception as e:
        return {'file': filepath.name, 'error': str(e)}


def main():
    parser = argparse.ArgumentParser(description='Optimize images for web')
    parser.add_argument('--quality', type=int, default=80, help='WebP quality (1-100)')
    parser.add_argument('--resize', type=int, default=0, help='Max width in pixels')
    parser.add_argument('--dry-run', action='store_true', help='Preview only')
    args = parser.parse_args()

    max_width = args.resize if args.resize > 0 else None

    if not IMAGES_DIR.exists():
        print(f"Images directory not found: {IMAGES_DIR}")
        sys.exit(1)

    # Get all image files
    image_exts = {'.png', '.jpg', '.jpeg'}
    image_files = sorted(
        [f for f in IMAGES_DIR.iterdir() if f.suffix.lower() in image_exts],
        key=lambda f: os.path.getsize(f),
        reverse=True,
    )

    print(f"Found {len(image_files)} images to optimize")
    total_saved = 0
    results = []

    for img_file in image_files:
        result = optimize_image(img_file, args.quality, max_width, args.dry_run)
        results.append(result)

        if 'error' in result:
            print(f"  ✗ {result['file']}: {result['error']}")
        elif args.dry_run:
            print(f"  → {result['file']}: {result['original_kb']:.0f}KB (would convert)")
        else:
            total_saved += result['original_kb'] - result['webp_kb']
            sign = '✓' if result['saved_pct'] > 0 else '='
            print(f"  {sign} {result['file']}: {result['original_kb']:.0f}KB → {result['webp_kb']:.0f}KB ({result['saved_pct']:.0f}%)")

    if not args.dry_run and results:
        total_orig = sum(r['original_kb'] for r in results if 'original_kb' in r)
        total_webp = sum(r['webp_kb'] for r in results if 'webp_kb' in r)
        print(f"\nTotal: {total_orig:.0f}KB → {total_webp:.0f}KB (saved {(1-total_webp/total_orig)*100:.0f}%)")

    print("\nDone. Add <picture> elements to serve WebP with fallback:")
    print("""
<picture>
  <source srcset="images/photo.webp" type="image/webp">
  <img src="images/photo.jpg" alt="..." loading="lazy" width="800" height="600">
</picture>
""")

if __name__ == '__main__':
    main()
