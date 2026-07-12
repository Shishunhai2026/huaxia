#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Build sitemap.xml dynamically from pages + articles directory.
"""
import os, re, datetime

BASE_URL = "https://www.csrenova.com"
ARTICLES_DIR = r"D:\cc\renova\website\renova-clinic\articles"
OUTPUT_DIR = r"D:\cc\renova\website\renova-clinic"
PREVIEW_DIR = r"D:\cc\renova\website\preview"

today = datetime.date.today().isoformat()

# Core pages
pages = [
    ("/", "weekly", "1.0"),
    ("/treatment", "monthly", "0.9"),
    ("/pricing", "monthly", "0.9"),
    ("/treatment-comparison", "monthly", "0.8"),
    ("/symptom-check", "monthly", "0.8"),
    ("/mens-health", "monthly", "0.7"),
    ("/about", "monthly", "0.8"),
    ("/disease-science", "weekly", "0.9"),
    ("/clinical-evidence", "monthly", "0.7"),
    ("/faq", "monthly", "0.8"),
    ("/patient-cases", "monthly", "0.6"),
    ("/contact", "monthly", "0.9"),
]

# Scan articles directory for slugs
article_urls = []
if os.path.isdir(ARTICLES_DIR):
    for fname in sorted(os.listdir(ARTICLES_DIR)):
        if fname.endswith('.html'):
            m = re.match(r'\d+-(.+)\.html', fname)
            if m:
                slug = m.group(1)
                article_urls.append((f"/disease-science/{slug}/", "monthly", "0.7"))

urls_xml = ""
for path, freq, priority in pages:
    urls_xml += f"""    <url>
        <loc>{BASE_URL}{path}</loc>
        <lastmod>{today}</lastmod>
        <changefreq>{freq}</changefreq>
        <priority>{priority}</priority>
        <mobile:mobile type="pc,mobile"/>
    </url>
"""

# Article separator comment
urls_xml += """
    <!-- ===== 100篇科普文章 ===== -->
"""
for path, freq, priority in article_urls:
    urls_xml += f"""    <url>
        <loc>{BASE_URL}{path}</loc>
        <lastmod>{today}</lastmod>
        <changefreq>{freq}</changefreq>
        <priority>{priority}</priority>
        <mobile:mobile type="pc,mobile"/>
    </url>
"""

sitemap = f"""<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:mobile="http://www.baidu.com/schemas/sitemap-mobile/1/"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
{urls_xml}
</urlset>
"""

# Write to both locations
for out_dir in [OUTPUT_DIR, PREVIEW_DIR]:
    path = os.path.join(out_dir, "sitemap.xml")
    with open(path, "w", encoding="utf-8") as f:
        f.write(sitemap)
    print(f"  Sitemap written: {path} ({len(pages) + len(article_urls)} URLs)")

print(f"\nDone! {len(pages)} pages + {len(article_urls)} articles = {len(pages) + len(article_urls)} total URLs")
