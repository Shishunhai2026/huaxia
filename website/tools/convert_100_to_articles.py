#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Convert 100篇/ HTML articles to WordPress articles/ format.
Matches by number prefix (01- through 100-).
"""
import os, re, sys

SRC_DIR = r"D:\cc\renova\100篇"
OUT_DIR = r"D:\cc\renova\website\renova-clinic\articles"
os.makedirs(OUT_DIR, exist_ok=True)

# 100 keyword -> (num, slug, category) mapping
KEYWORDS = [
    # 1-15: 症状自查与认知
    ("勃起困难是什么原因", "boqi-kunnan-yuanyin", "症状自查与认知"),
    ("硬度不够算阳痿吗", "yingdu-bugou-suan-yangwei", "症状自查与认知"),
    ("硬不起来是什么原因", "ying-bu-qilai-yuanyin", "症状自查与认知"),
    ("最近房事中途疲软怎么回事", "zhongtu-piruan-zenme-huishi", "症状自查与认知"),
    ("硬度分级1-4级怎么判断", "yingdu-fenji-panduan", "症状自查与认知"),
    ("晨勃正常但做爱时不行是心理还是器质性的", "chenbo-zhengchang-xinli-qiizhi", "症状自查与认知"),
    ("不能完全勃起是怎么回事", "bu-neng-wanquan-boqi", "症状自查与认知"),
    ("硬一会就软了是什么问题", "ying-yihui-jiu-ruan-le", "症状自查与认知"),
    ("突然硬不起来了怎么回事", "turan-ying-bu-qilai", "症状自查与认知"),
    ("晨勃消失了正常吗", "chenbo-xiaoshi-zhengchang-ma", "症状自查与认知"),
    ("晨勃减少了是什么原因", "chenbo-jianshao-yuanyin", "症状自查与认知"),
    ("半硬不硬算ED吗", "ban-ying-bu-ying-suan-ED", "症状自查与认知"),
    ("怎么判断自己是不是阳痿", "zenme-panduan-yangwei", "症状自查与认知"),
    ("ED严重程度怎么分", "ED-yanzhong-chengdu-fenji", "症状自查与认知"),
    ("没有晨勃是不是阳痿", "meiyou-chenbo-shi-bushi-yangwei", "症状自查与认知"),
    # 16-30: 病因探索
    ("年轻人为什么会阳痿", "nianqingren-wei-shenme-yangwei", "病因探索"),
    ("糖尿病会导致阳痿吗", "tangniaobing-daozhi-yangwei", "病因探索"),
    ("高血压会导致ED吗", "gaoxueya-daozhi-ED", "病因探索"),
    ("手淫会导致阳痿吗", "shouyin-daozhi-yangwei", "病因探索"),
    ("压力大会导致阳痿吗", "yali-daozhi-yangwei", "病因探索"),
    ("熬夜会导致阳痿吗", "aoye-daozhi-yangwei", "病因探索"),
    ("吸烟会导致阳痿吗", "xiyan-daozhi-yangwei", "病因探索"),
    ("阳痿是肾虚引起的吗", "yangwei-shenxu-yinqi", "病因探索"),
    ("ED和心血管疾病有什么关系", "ED-xinxueguan-guanxi", "病因探索"),
    ("40岁男人勃起功能下降是正常的吗", "40sui-boqi-xiajiang-zhengchang", "病因探索"),
    ("心理因素会导致阳痿吗", "xinli-yinsu-daozhi-yangwei", "病因探索"),
    ("前列腺炎会引起阳痿吗", "qianliexianyan-yinqi-yangwei", "病因探索"),
    ("长期吃降压药会导致ED吗", "changqi-jiangyayao-ED", "病因探索"),
    ("肥胖会导致阳痿吗", "feipang-daozhi-yangwei", "病因探索"),
    ("腰椎间盘突出会影响勃起吗", "yaozhui-tuchu-boqi", "病因探索"),
    # 31-45: 求医问药——本地精准搜索
    ("长沙看ED哪个医院好", "changsha-kan-ED-nage-yiyuan-hao", "求医问药——本地精准搜索"),
    ("长沙治阳痿最好的医院", "changsha-zhi-yangwei-zuihao-yiyuan", "求医问药——本地精准搜索"),
    ("长沙男科医院排名", "changsha-nanke-yiyuan-paiming", "求医问药——本地精准搜索"),
    ("长沙男科哪家好", "changsha-nanke-najia-hao", "求医问药——本地精准搜索"),
    ("长沙男科医院排名前十", "changsha-nanke-paiming-qianshi", "求医问药——本地精准搜索"),
    ("长沙县男科医院", "changshaxian-nanke-yiyuan", "求医问药——本地精准搜索"),
    ("星沙男科医院", "xingsha-nanke-yiyuan", "求医问药——本地精准搜索"),
    ("星沙治疗阳痿", "xingsha-zhiiliao-yangwei", "求医问药——本地精准搜索"),
    ("长沙看男科最好的医生", "changsha-nanke-zuihao-yisheng", "求医问药——本地精准搜索"),
    ("长沙男科专家", "changsha-nanke-zhuanjia", "求医问药——本地精准搜索"),
    ("长沙县星沙镇看ED", "changshaxian-xingshazhen-kan-ED", "求医问药——本地精准搜索"),
    ("星沙汽车站附近医院", "xingsha-qichezhan-fujin-yiyuan", "求医问药——本地精准搜索"),
    ("长沙治疗阳痿去哪家医院靠谱不坑人", "changsha-yangwei-kaopu-bu-kengren", "求医问药——本地精准搜索"),
    ("长沙男科医院靠谱吗", "changsha-nanke-kaopu-ma", "求医问药——本地精准搜索"),
    ("长沙男科哪家不坑人", "changsha-nanke-bu-kengren", "求医问药——本地精准搜索"),
    # 46-60: 治疗方案探索
    ("阳痿怎么治疗最好", "yangwei-zenme-zhiliao-zuihao", "治疗方案探索"),
    ("不吃药能治好ED吗", "bu-chiyao-neng-zhi-hao-ED", "治疗方案探索"),
    ("阳痿能治好吗要花多少钱", "yangwei-neng-zhihao-duoshao-qian", "治疗方案探索"),
    ("治疗勃起功能障碍最好的方法", "zhiliao-boqi-gongneng-zhangai-fangfa", "治疗方案探索"),
    ("有没有不手术不吃药治疗阳痿的方法", "bu-shoushu-bu-chiyao-fangfa", "治疗方案探索"),
    ("低能量冲击波治疗ED", "di-nengliang-chongjibo-ED", "治疗方案探索"),
    ("Renova冲击波治疗阳痿有效吗", "Renova-chongjibo-you-xiao-ma", "治疗方案探索"),
    ("冲击波治疗ED和吃药哪个效果好", "chongjibo-vs-chiyao-xiaoguo", "治疗方案探索"),
    ("血管性ED怎么治疗能根治吗", "xueguanxing-ED-zhiliao-genzhi", "治疗方案探索"),
    ("伟哥没效果了怎么办", "weige-mei-xiaoguo-zenmeban", "治疗方案探索"),
    ("有什么新技术可以治疗阳痿", "xin-jishu-zhiliao-yangwei", "治疗方案探索"),
    ("中医治疗阳痿效果好吗", "zhongyi-zhiliao-yangwei-xiaoguo", "治疗方案探索"),
    ("阳痿自己能恢复吗", "yangwei-ziji-neng-huifu-ma", "治疗方案探索"),
    ("不吃药不手术治ED", "bu-chiyao-bu-shoushu-zhi-ED", "治疗方案探索"),
    ("ED物理治疗", "ED-wuli-zhiliao", "治疗方案探索"),
    # 61-70: 费用与医保
    ("Renova冲击波治疗一次多少钱长沙", "Renova-chongjibo-yici-duoshao-qian", "费用与医保"),
    ("长沙治疗阳痿多少钱", "changsha-zhiliao-yangwei-duoshao-qian", "费用与医保"),
    ("阳痿检查费用多少钱", "yangwei-jiancha-feiyong", "费用与医保"),
    ("冲击波治疗ED费用", "chongjibo-zhiliao-ED-feiyong", "费用与医保"),
    ("治疗阳痿医保能报销吗", "zhiliao-yangwei-yibao-baoxiao", "费用与医保"),
    ("ED治疗能用医保吗", "ED-zhiliao-yibao-ma", "费用与医保"),
    ("9600元一个疗程治疗ED值不值", "9600-yuan-yige-liaocheng-zhi-bu-zhi", "费用与医保"),
    ("伟哥多少钱一片", "weige-duoshao-qian-yi-pian", "费用与医保"),
    ("长期吃伟哥一年要花多少钱", "changqi-chi-weige-yinian-duoshao-qian", "费用与医保"),
    ("长沙治疗阳痿哪家便宜", "changsha-zhiliao-yangwei-najia-pianyi", "费用与医保"),
    # 71-80: 药物相关
    ("西地那非和他达拉非哪个副作用小", "xidinafei-vs-tadalafei-fuzuoyong", "药物相关"),
    ("伟哥会不会上瘾", "weige-shangyin-ma", "药物相关"),
    ("伟哥可以长期吃吗", "weige-changqi-chi-ma", "药物相关"),
    ("吃伟哥有依赖性吗", "chi-weige-yilai-xing-ma", "药物相关"),
    ("他达拉非5mg每天吃安全吗", "tadalafei-5mg-meitian-anquan-ma", "药物相关"),
    ("金戈和万艾可哪个好", "jinge-vs-wanaike-nage-hao", "药物相关"),
    ("伟哥吃了没效果是什么原因", "weige-chile-mei-xiaoguo-yuanyin", "药物相关"),
    ("希爱力副作用大吗", "xiaaili-fuzuoyong-da-ma", "药物相关"),
    ("中药治阳痿有效吗", "zhongyao-zhi-yangwei-you-xiao-ma", "药物相关"),
    ("六味地黄丸治阳痿吗", "liuwei-dihuang-wan-zhi-yangwei", "药物相关"),
    # 81-88: 就医顾虑与隐私
    ("去男科看病会不会很尴尬", "qu-nanke-kanbing-ganga-ma", "就医顾虑与隐私"),
    ("看ED需要做哪些检查疼吗", "kan-ED-xuyao-jiancha-teng-ma", "就医顾虑与隐私"),
    ("阳痿了怎么跟医生说", "yangwei-zenme-gen-yisheng-shuo", "就医顾虑与隐私"),
    ("一个人去看男科丢人吗", "yigeren-qu-kan-nanke-diuren-ma", "就医顾虑与隐私"),
    ("看阳痿要住院吗", "kan-yangwei-yao-zhuyuan-ma", "就医顾虑与隐私"),
    ("看男科需要带什么", "kan-nanke-xuyao-dai-shenme", "就医顾虑与隐私"),
    ("男科检查多少钱", "nanke-jiancha-duoshao-qian", "就医顾虑与隐私"),
    ("长沙男科周末上班吗", "changsha-nanke-zhoumo-shangban", "就医顾虑与隐私"),
    # 89-96: 效果预期与康复
    ("阳痿能彻底治好吗", "yangwei-neng-chedi-zhihao-ma", "效果预期与康复"),
    ("重度阳痿还能治好吗", "zhongdu-yangwei-hai-neng-zhihao", "效果预期与康复"),
    ("糖尿病阳痿能治好吗", "tangniaobing-yangwei-neng-zhihao", "效果预期与康复"),
    ("阳痿治疗需要多长时间", "yangwei-zhiliao-xuyao-duochang-shijian", "效果预期与康复"),
    ("做了冲击波治疗后多久能看到效果", "chongjibo-zhiliao-hou-duojiu-xiaoguo", "效果预期与康复"),
    ("阳痿治疗后还会复发吗", "yangwei-zhiliao-hou-fufa-ma", "效果预期与康复"),
    ("冲击波治疗效果能维持多久", "chongjibo-xiaoguo-weichi-duojiu", "效果预期与康复"),
    ("年轻人阳痿怎么调理恢复快", "nianqingren-yangwei-tiaoli-huifu", "效果预期与康复"),
    # 97-100: AI搜索长尾自然语言句式
    ("老婆让我去看阳痿我该怎么办", "laopo-rang-wo-kan-yangwei-zenmeban", "AI搜索长尾自然语言句式"),
    ("长沙哪家医院看男科正规不忽悠", "changsha-nake-zhenggui-bu-huyou", "AI搜索长尾自然语言句式"),
    ("硬度不够怎么调理吃什么能改善", "yingdu-bugou-tiaoli-chi-shenme", "AI搜索长尾自然语言句式"),
    ("糖尿病引起的阳痿还有救吗怎么治", "tangniaobing-yinqi-yangwei-jiu-ma", "AI搜索长尾自然语言句式"),
]

def html_to_gutenberg_blocks(body):
    """Convert HTML to WordPress Gutenberg block comments."""
    body = re.sub(r'<h2[^>]*>(.*?)</h2>',
                  r'<!-- wp:heading {"level":2} -->\n<h2>\1</h2>\n<!-- /wp:heading -->',
                  body)
    body = re.sub(r'<h3[^>]*>(.*?)</h3>',
                  r'<!-- wp:heading {"level":3} -->\n<h3>\1</h3>\n<!-- /wp:heading -->',
                  body)
    body = re.sub(r'<p[^>]*>', '<!-- wp:paragraph -->\n<p>', body)
    body = re.sub(r'</p>', '</p>\n<!-- /wp:paragraph -->', body)
    body = re.sub(r'<ul[^>]*>', '<!-- wp:list -->\n<ul>', body)
    body = re.sub(r'</ul>', '</ul>\n<!-- /wp:list -->', body)
    body = re.sub(r'<ol[^>]*>', '<!-- wp:list {"ordered":true} -->\n<ol>', body)
    body = re.sub(r'</ol>', '</ol>\n<!-- /wp:list -->', body)
    body = re.sub(r'<table[^>]*>', '<!-- wp:table -->\n<figure class="wp-block-table"><table>', body)
    body = re.sub(r'</table>', '</table></figure>\n<!-- /wp:table -->', body)
    return body.strip()

def generate_excerpt(body):
    text = re.sub(r'<[^>]+>', '', body)
    text = re.sub(r'\s+', '', text)
    if len(text) > 120:
        return text[:120] + '...'
    return text

# Index source files by number prefix
src_by_num = {}
for fname in os.listdir(SRC_DIR):
    if fname.endswith('.html'):
        m = re.match(r'(\d+)-', fname)
        if m:
            src_by_num[int(m.group(1))] = os.path.join(SRC_DIR, fname)

print(f"Found {len(src_by_num)} source files in {SRC_DIR}")

converted = 0
for idx, (keyword, slug, category) in enumerate(KEYWORDS):
    num = idx + 1
    src_path = src_by_num.get(num)
    if not src_path:
        print(f"  MISS #{num:03d}: {keyword}")
        continue

    with open(src_path, 'r', encoding='utf-8') as f:
        html = f.read()

    # Extract title from <h1>
    m = re.search(r'<h1>(.*?)</h1>', html, re.DOTALL)
    title = m.group(1).strip() if m else keyword

    # Extract category from meta
    m = re.search(r'分类：(.+?)</em>', html)
    display_cat = m.group(1).strip() if m else category

    # Extract body - from end of author line to start of clinic-info
    m = re.search(r'</em></p>\s*(.*?)<div class="clinic-info"', html, re.DOTALL)
    if not m:
        m = re.search(r'</em></p>\s*(.*?)</article>', html, re.DOTALL)
    if not m:
        m = re.search(r'</h1>\s*<p><em>.*?</em></p>\s*(.*?)<div class="clinic-info"', html, re.DOTALL)
    body = m.group(1).strip() if m else ""

    if not body or len(body) < 100:
        print(f"  EMPTY #{num:03d}: {keyword} (body={len(body)} chars)")
        continue

    # Generate tags from body content
    tags = []
    strongs = re.findall(r'<strong>(.*?)</strong>', body)
    seen = set()
    for s in strongs:
        s2 = re.sub(r'<[^>]+>', '', s).strip()
        if len(s2) > 3 and s2 not in seen:
            seen.add(s2)
            tags.append(s2[:30])
            if len(tags) >= 5:
                break

    excerpt = generate_excerpt(body)
    gutenberg_body = html_to_gutenberg_blocks(body)

    # Build the article
    header = f'<!--\nWordPress Post Import\nTitle: {title}\nCategory: disease-science\nTags: {", ".join(tags)}\nExcerpt: {excerpt}\n-->\n\n'

    out_name = f"{str(num).zfill(2)}-{slug}.html"
    out_path = os.path.join(OUT_DIR, out_name)
    with open(out_path, 'w', encoding='utf-8') as f:
        f.write(header + gutenberg_body)

    # Verify the slug matches glob pattern: *-{slug}.html
    # PHP does: glob(RENOVA_DIR . '/articles/*-' . basename($slug) . '.html')
    # This needs the filename to END with "-{slug}.html"
    # Current: NN-{slug}.html where slug matches exactly

    print(f"  OK #{num:03d}: {out_name} [{display_cat}] ({len(body)} chars)")
    converted += 1

# Also handle #100 separately since it's a special case
print(f"\nDone! Converted {converted} files to {OUT_DIR}")
print(f"Total files in output: {len([f for f in os.listdir(OUT_DIR) if f.endswith('.html')])}")
