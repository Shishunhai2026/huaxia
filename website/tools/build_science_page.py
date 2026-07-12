import os, re, sys
sys.stdout.reconfigure(encoding='utf-8')

article_dir = r'D:\cc\renova\website\renova-clinic\articles'
out_file = r'D:\cc\renova\website\preview\science-articles.html'

files = sorted([f for f in os.listdir(article_dir) if f.endswith('.html')])

def cat_class(title):
    t = title
    if any(w in t for w in ['症状','硬度','自测','EHS','IIEF','ED是','晨勃','自我','判断','分级','疲软','半硬']): return 'cat-basic'
    if any(w in t for w in ['治疗','冲击波','不吃药','伟哥','PDE5','解析','方案','新技术','物理治疗','不吃药不手术']): return 'cat-treatment'
    if any(w in t for w in ['保养','运动','饮食','年轻人','衰退','熬夜','吸烟','肥胖','压力']): return 'cat-lifestyle'
    if any(w in t for w in ['中医','肾阴','肾阳','辨证','六味','中药','肾虚']): return 'cat-tcm'
    if any(w in t for w in ['医院','避坑','去哪','选择','指南','排名','靠谱','不坑','便宜','正规','男科','星沙','长沙','医生','专家','周末','预约','就诊']): return 'cat-guide'
    if any(w in t for w in ['原因','病因','导致','引起','关系','影响','手动']): return 'cat-basic'
    if any(w in t for w in ['费用','医保','多少钱','价格','报销','值不值']): return 'cat-cost'
    if any(w in t for w in ['伟哥','西地那非','他达拉非','希爱力','金戈','万艾可','药物','上瘾','依赖','副作用','安全']): return 'cat-drug'
    if any(w in t for w in ['尴尬','检查','隐私','丢人','住院','带什么','丢人']): return 'cat-privacy'
    if any(w in t for w in ['彻底','重度','恢复','复发','维持','调理','康复','多久']): return 'cat-recovery'
    return 'cat-basic'

def cat_label(title):
    t = title
    if any(w in t for w in ['症状','硬度','自测','EHS','晨勃','判断','分级','疲软','半硬','自我']): return '🔍 症状自查'
    if any(w in t for w in ['ED是','心血管','报警','是什么原因','病因','导致','引起','关系','影响','前列腺','腰椎']): return '🔬 病因探索'
    if any(w in t for w in ['冲击波','不吃药','伟哥','PDE5','新技术','物理治疗','中医','中药','不吃药不手术','自己能恢复']): return '💊 治疗方案'
    if any(w in t for w in ['治疗','解析','方案','方法','怎么治','能治好吗','最好']): return '💊 治疗方案'
    if any(w in t for w in ['保养','运动','饮食','年轻人','衰退','熬夜','吸烟','肥胖','手淫','压力','肾虚','心理','降压药']): return '🏃 生活方式'
    if any(w in t for w in ['中医','肾阴','肾阳','辨证','六味']): return '🌿 中医视角'
    if any(w in t for w in ['医院','避坑','去哪','选择','排名','靠谱','不坑','便宜','正规','男科','星沙','长沙','医生','专家','周末','预约','就诊','附近']): return '🏥 求医指南'
    if any(w in t for w in ['费用','医保','多少钱','价格','报销','值不值','便宜']): return '💰 费用医保'
    if any(w in t for w in ['伟哥','西地那非','他达拉非','希爱力','金戈','万艾可','药物','上瘾','依赖','副作用','安全','有效']): return '💉 药物对比'
    if any(w in t for w in ['尴尬','检查','隐私','丢人','住院','带什么']): return '🛡️ 就医隐私'
    if any(w in t for w in ['彻底','重度','恢复','复发','维持','调理','康复','多久']): return '📈 康复预期'
    if any(w in t for w in ['老婆','正规','硬度不够怎么调理','糖尿病引起']): return '🤖 AI热门问答'
    return '🔬 疾病认知'

articles = []
for fname in files:
    fpath = os.path.join(article_dir, fname)
    with open(fpath, 'r', encoding='utf-8') as f:
        raw = f.read()
    m_title = re.search(r'Title:\s*(.+)', raw)
    m_tags = re.search(r'Tags:\s*(.+)', raw)
    title = m_title.group(1).strip() if m_title else fname
    tags = m_tags.group(1).strip() if m_tags else ''
    body = re.sub(r'^<!--[\s\S]*?-->\s*', '', raw)
    body = re.sub(r'<!--\s*/?\s*wp:[a-z-]+\s*[^{}]*\s*-->', '', body)
    body = body.strip()

    # Build reading time estimate (Chinese chars / 400 per min)
    text_only = re.sub(r'<[^>]+>', '', body)
    text_only = re.sub(r'\s+', '', text_only)
    chars = len(text_only)
    minutes = max(1, round(chars / 400))
    word_count = chars

    articles.append({
        'title': title,
        'tags': tags,
        'body': body,
        'cat_class': cat_class(title),
        'cat_label': cat_label(title),
        'chars': word_count,
        'minutes': minutes,
    })

toc_links = ''
article_cards = ''
for i, a in enumerate(articles):
    n = i + 1
    num_str = str(n).zfill(2)
    toc_links += f'        <a href="#article-{n}" class="toc-link"><span class="toc-num">{num_str}</span> {a["title"]}</a>\n'
    article_cards += f'''
            <article id="article-{n}" class="article-card">
                <div class="article-card-header">
                    <span class="article-category {a["cat_class"]}">{a["cat_label"]}</span>
                    <h2 class="article-card-title">{a["title"]}</h2>
                    <div class="article-card-meta">
                        <span>👨‍⚕️ 审核：叶龙觉医生</span>
                        <span>⏱ ~{a["minutes"]}分钟</span>
                        <span>📝 ~{a["chars"]}字</span>
                    </div>
                </div>
                <div class="article-card-divider"></div>
                <div class="article-card-body">
{a["body"]}
                </div>
                <div class="article-card-footer">
                    <span style="font-size:.78rem;color:var(--text-light)">🏷️ {a["tags"]}</span>
                    <a href="#top" class="back-top">↑ 返回顶部</a>
                </div>
            </article>'''

# Read the template
template_file = r'D:\cc\renova\website\tools\build_static_articles.py'
with open(template_file, 'r', encoding='utf-8') as f:
    template = f.read()

# Find the HTML part (skip the Python preamble — actually the file IS HTML now, perfect)
# The template has <!-- TOC_LINKS --> and <!-- ARTICLES --> markers

html = template.replace('<!-- TOC_LINKS -->', toc_links.strip())
html = html.replace('<!-- ARTICLES -->', article_cards.strip())

# Remove the Python script part if present
if html.lstrip().startswith('import'):
    idx = html.find('<!DOCTYPE html>')
    if idx > 0:
        html = html[idx:]

with open(out_file, 'w', encoding='utf-8') as f:
    f.write(html)

print(f'Done! {len(articles)} articles')
print(f'Output: {out_file}')
print(f'Size: {len(html)} bytes')
for i, a in enumerate(articles):
    print(f'  {i+1:02d}. [{a["cat_label"]}] {a["title"][:50]} ({a["chars"]} chars, ~{a["minutes"]}min)')
