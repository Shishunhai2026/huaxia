# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project overview

真颜堂中医诊所 (Zhenyan Tang TCM Clinic) — a medical clinic in Changsha, Hunan, offering Renova linear shockwave therapy for vascular erectile dysfunction (ED). The website is a patient-acquisition tool targeting Hunan-based users searching for ED-related keywords on Baidu and AI-powered search engines (豆包, Kimi, 秘塔).

**Two parallel deliverables live in `website/`:**

| Path | Purpose |
|------|---------|
| `website/renova-clinic/` | WordPress theme — the production site |
| `website/preview/index.html` | Self-contained static preview — mirrors all pages in a single HTML file for offline review/demo |

## Clinic info (hardcoded throughout — use `grep` + `sed` to batch-replace if renamed)

- Name: 真颜堂中医诊所
- Doctor: 翁青山 博士 (PhD)
- Address: 长沙市雨花区沙湾路品缦芸酒店5楼
- Phone: 18973134733
- Device: Renova (国械注进20173095171), 3600-5000 shots/session
- Price: 9600元/4-session course

## WordPress theme architecture

### Theme metadata

Defined in `style.css` header comment. Text domain: `renova-clinic`.

### Template hierarchy

| File | Role |
|------|------|
| `front-page.php` | Homepage (Hero, advantages, stats, treatment intro, testimonials, FAQ, CTA) |
| `page.php` | Generic page shell |
| `single.php` | Blog/article detail with sidebar |
| `index.php` | Blog listing (疾病科普) with sidebar |
| `header.php` / `footer.php` | Shared chrome |
| `functions.php` | Theme init, asset enqueue, SEO meta injection, Schema output |

### Page templates (`page-templates/`)

Each is registered via `Template Name:` header comment. Create WordPress pages with matching slugs:

| Template file | Page slug |
|---------------|-----------|
| `about.php` | `/about` |
| `treatment.php` | `/treatment` |
| `disease-science.php` | `/disease-science` |
| `clinical-evidence.php` | `/clinical-evidence` |
| `faq.php` | `/faq` |
| `patient-cases.php` | `/patient-cases` |
| `contact.php` | `/contact` |

### SEO architecture (`functions.php`)

Four layers of SEO hooks, all on `wp_head`:

1. **Meta tags** (priority 1): `renova_meta_description()`, `renova_meta_keywords()`, `renova_dns_prefetch()`
2. **Canonical URL** (priority 2): `renova_canonical_url()`
3. **Open Graph + Twitter Card** (priority 3): `renova_og_tags()`
4. **JSON-LD Schema** (priorities 10-12):
   - `renova_schema_clinic()` — MedicalClinic + Physician
   - `renova_schema_article()` — MedicalWebPage (single posts only)
   - `renova_schema_faq_page()` — FAQPage (FAQ page only)

Additional Schema helpers in `inc/schema.php` — `renova_get_clinic_schema()`, `renova_get_faq_schema()`, `renova_get_breadcrumb_schema()`, `renova_get_article_schema()`.

### Design system (`style.css`)

CSS custom properties define the entire theme:

- **Colors**: `--primary: #8B4513` (warm brown), `--accent: #C17817`, `--bg-warm: #FDF5E6`, `--bg-cream: #FFFAF0`
- **Typography**: `--font-heading: 'Georgia', 'Noto Serif SC', serif`, `--font-body: system-ui, 'PingFang SC', sans-serif`
- **Spacing/shadows**: `--radius: 14px`, three-tier shadow system (`--shadow-sm/md/lg`)

The preview HTML inlines all CSS/JS — no external dependencies beyond Google Fonts.

### Articles (`articles/`)

8 SEO-optimized articles (HTML fragments for WordPress import). Each targets specific long-tail keywords. All reference real SCI literature from the Renova clinical evidence base.

## Static preview (`preview/index.html`)

Single-file, self-contained. Contains every page as `<div id="section-name">` blocks. Open directly in browser — no server needed.

**Key patterns when editing:**
- All styles in a single `<style>` block (no external CSS)
- All JS in a single `<script>` block at bottom
- SVG icons defined as an inline `<svg style="display:none"><symbol id="icon-*">` sprite sheet at the top of `<body>`
- Images in `preview/images/` — extracted from the clinic's PPTX training materials and PDF brochures
- Three JSON-LD blocks before `</body>`: MedicalClinic, FAQPage, BreadcrumbList

## Global replacements (when clinic info changes)

When the clinic name, doctor name, address, or phone changes, update both the WordPress theme AND the preview. Use Python batch-replace across all files:

```bash
python -c "
import os, glob
base = 'D:/cc/renova/website'
changes = {'OLD':'NEW', ...}
for f in glob.glob(f'{base}/**/*', recursive=True):
    if any(f.endswith(ext) for ext in ['.php','.html','.css','.md','.xml','.txt','.js','.conf']):
        with open(f, 'r', encoding='utf-8') as fh: c = fh.read()
        nc = c
        for o,n in changes.items(): nc = nc.replace(o,n)
        if nc != c:
            with open(f, 'w', encoding='utf-8') as fh: fh.write(nc)
"
```

## Source materials (not in repo)

Large files in `D:/cc/renova/` root are excluded via `.gitignore`:
- `RENOVA文献汇编.pdf` — 20+ SCI paper compilation
- `Renova产品理论知识培训与交流-常州20231227.pptx` — training deck (65 slides, from which device images were extracted)
- `renova产品使用说明书+正文+封面+印刷.pdf` — product manual
- `封面墙面宣传及易拉宝资料/` — promotional materials, brochures, DM ads

## Deployment order

1. **ICP备案** first — medical websites in China require ICP filing before going live (~20 business days)
2. During filing: build on staging with server IP
3. After filing approved: bind domain, submit to Baidu Webmaster Tools (ziyuan.baidu.com), claim Baidu Maps listing
4. Install WordPress → activate theme → create pages with matching slugs → import articles
5. Replace `YOUR_DOMAIN` placeholders across sitemap.xml, robots.txt, og:url, Schema @id
6. Replace `REPLACE_WITH_BAIDU_VERIFICATION_CODE` in header.php meta tag
