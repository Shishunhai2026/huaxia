# -*- coding: utf-8 -*-
"""Rebuild ALL ~101 new ED articles with proper English slugs + expert-note divs."""
import os

OUT = r'D:\cc\renova\website\renova-clinic\articles'
os.makedirs(OUT, exist_ok=True)

EXISTING = {
    '01-chongjibo-ED-xiaoguo', '02-ED-bu-chiyao', '03-PDE5i-wuxiao',
    '04-nanxing-baoyang', '05-xueguanxing-ED', '06-tangniaobing-ED',
    '07-ED-xinxueguan', '08-ED-zhiliao-zonglan', '09-ED-symptom-selfcheck',
    '10-young-men-ED-causes', '11-lifestyle-improve-ED', '12-how-to-choose-ED-clinic',
    '13-TCM-ED-syndrome-differentiation',
}

def a(num, slug, title, tags, excerpt, body):
    """Create article with full expert-note wrapping."""
    content = f'''<!--
WordPress Post Import
Title: {title}
Category: disease-science
Tags: {tags}
Excerpt: {excerpt}
-->
<!-- wp:heading -->
<h2>{title}</h2>
<!-- /wp:heading -->

{body}

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>本文仅供健康科普参考，不能替代专业医疗诊断。如有ED相关症状，建议到正规医疗机构就诊，由专业医生评估后制定个性化治疗方案。长沙地区患者可预约叶龙觉医生面诊，电话15909415555。</p>
</div>
'''
    fname = f'{num:02d}-{slug}.html'
    filepath = os.path.join(OUT, fname)
    if slug in EXISTING:
        print(f'SKIP (exists): {fname}')
        return
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)
    print(f'CREATED: {fname}')

# ═══════════════════════════════════════════════════════
# ALL ARTICLES (num starts from 14)
# ═══════════════════════════════════════════════════════

# ── #1 勃起困难是什么原因 ── (14 already exists, skip)

# ── #2 硬度不够算阳痿吗 ──
a(15, 'yingdu-bugou-shi-yangwei-ma', '硬度不够算阳痿吗',
  '硬度不够,阳痿,ED自测,勃起硬度分级,EHS',
  '硬度不够不一定就是阳痿。用EHS硬度分级帮您判断什么程度的硬度下降需要就医。',
  '''<!-- wp:paragraph -->
<p>"最近硬度不够，是不是阳痿了？"答案是：<strong>不一定。</strong>硬度下降和阳痿（ED）之间有一个重要的"灰色地带"——关键看三点：持续时间、发生频率、晨勃状态。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>先用EHS硬度分级自我对照</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>国际通用的EHS勃起硬度分为4级：<strong>1级（豆腐）</strong>阴茎胀大但不硬——明确ED信号；<strong>2级（剥皮香蕉）</strong>有硬度但不足以插入——中度ED；<strong>3级（带皮香蕉）</strong>可以插入但不够坚挺——轻度ED或亚健康状态；<strong>4级（黄瓜）</strong>完全坚挺——正常。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>三个判断标准</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>持续时间：</strong>偶尔一两次（<1个月）→观察；持续超过3个月→就医</li>
<li><strong>发生频率：</strong><25%的性生活受影响→可能正常波动；>50%→建议评估</li>
<li><strong>晨勃状态：</strong>晨勃正常→偏向心理性；晨勃也消失→提示器质性</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>最重要的一条：</strong>不要自己吓自己。很多男性因为一两次"表现不佳"就陷入焦虑→硬度更差→更焦虑的恶性循环。如果确实担心，到正规医疗机构做个IIEF-EF量表评估就清楚了。长沙地区患者可预约星沙华夏医院叶龙觉医生面诊。</p>
<!-- /wp:paragraph -->''')

# ── #3 硬不起来是什么原因 ──
a(16, 'ying-bu-qilai-yuanyin', '硬不起来是什么原因',
  '硬不起来原因,勃起困难原因,ED病因,硬度不够',
  '"硬不起来"的原因包括血管性、神经性、内分泌、心理性、药物性和生活方式六大类。了解病因是解决问题的第一步。',
  '''<!-- wp:paragraph -->
<p>"硬不起来"是很多男性最难启齿的困扰。从医学角度看，这不是一个单一疾病，而是多种病因导致的共同症状。了解真正的原因，才能找到正确的解决方案。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>硬不起来的六大原因</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>血管性（约70%）：</strong>阴茎血管功能异常——动脉供血不足（高血压/高血脂/糖尿病/吸烟损害血管内皮）或静脉漏（血液留不住）。这是最常见的器质性ED病因。</li>
<li><strong>神经性：</strong>糖尿病神经病变、腰椎间盘突出、盆腔手术损伤勃起神经。</li>
<li><strong>内分泌性：</strong>睾酮水平低下、高泌乳素血症、甲状腺功能异常、肥胖。激素是勃起的"燃料"。</li>
<li><strong>心理性：</strong>表现焦虑、抑郁、压力——40岁以下最常见。好在晨勃通常正常。</li>
<li><strong>药物性：</strong>部分降压药、抗抑郁药、非那雄胺等可影响勃起。</li>
<li><strong>生活方式性：</strong>吸烟（ED风险1.5-2倍）、缺乏运动、肥胖、熬夜（睾酮降10%-15%）。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>最重要的第一步：区分类型</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>晨勃正常+特定情境硬不起来</strong>→更可能是心理性；<strong>晨勃也消失+逐渐加重</strong>→更可能是器质性。最终诊断需要到医院做IIEF-EF量表+必要检查。找到病因才能对症治疗。叶龙觉医生在长沙星沙华夏医院提供专业评估。</p>
<!-- /wp:paragraph -->''')

# ── #4 最近房事中途疲软怎么回事 ──
a(17, 'fangshi-zhongtu-piruan', '最近房事中途疲软怎么回事',
  '中途疲软,勃起维持困难,静脉性ED,ED原因',
  '房事中途疲软是静脉性ED的典型表现——血液"留不住"。本文分析可能的原因和应对方案。',
  '''<!-- wp:paragraph -->
<p>门诊中经常遇到这样的描述："刚开始还好好的，做到一半就软了"。这种"中途疲软"在医学上称为<strong>勃起维持困难</strong>，通常指向特定病因。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>最可能的原因：静脉闭塞功能障碍</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>正常勃起时白膜压迫引流静脉将血液"锁"在海绵体内。如果这个"阀门"出了问题——血液进去了又流出来——表现为<strong>勃起快、软得也快</strong>。常见诱因：糖尿病海绵体纤维化、Peyronie病、年龄相关的白膜弹性下降、长期吸烟导致的微血管损伤。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>其他可能原因</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>心理因素：</strong>表现焦虑——前戏时正常，正式"上场"时紧张导致交感神经过度兴奋</li>
<li><strong>药物影响：</strong>某些降压药、抗抑郁药（SSRI类）</li>
<li><strong>睾酮偏低：</strong>性欲和勃起维持都需要足够的雄激素支撑</li>
<li><strong>疲劳/酒精：</strong>一过性的，消除诱因后恢复</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>怎么办？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>如果<strong>连续3个月、>50%的性生活都出现中途疲软</strong>，建议就医。诊断首选阴茎彩色多普勒超声（CDDU）。治疗方面，血管性因素可用Renova低能量冲击波促进血管新生改善海绵体血供，配合盆底肌训练进一步增强静脉闭塞机制。长沙地区可预约叶龙觉医生面诊评估（15909415555）。</p>
<!-- /wp:paragraph -->''')

# Continue generating more articles... I'll do them in batches
print("Starting article generation...")
