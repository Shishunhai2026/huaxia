# -*- coding: utf-8 -*-
"""Batch generate remaining ~86 ED科普 articles for the 100-keyword list.
Each article: 400-2000 chars, WordPress Gutenberg block format, SEO/GEO optimized.
Written as a senior andrologist (资深男科医生叶龙觉).
"""

import os

OUT = 'D:/cc/renova/website/renova-clinic/articles'

# ── Existing articles (14) — skip these ──
EXISTING = {
    '01-chongjibo-ED-xiaoguo',
    '02-ED-bu-chiyao',
    '03-PDE5i-wuxiao',
    '04-nanxing-baoyang',
    '05-xueguanxing-ED',
    '06-tangniaobing-ED',
    '07-ED-xinxueguan',
    '08-ED-zhiliao-zonglan',
    '09-ED-symptom-selfcheck',
    '10-young-men-ED-causes',
    '11-lifestyle-improve-ED',
    '12-how-to-choose-ED-clinic',
    '13-TCM-ED-syndrome-differentiation',
    '14-ed-hardness-causes',
}

# ── Article template ──
def make_article(num, slug, title, category, tags, excerpt, body_html):
    """Wrap body in WordPress Gutenberg import format."""
    body_blocks = []
    # title as h2 (Gutenberg block)
    body_blocks.append('<!-- wp:heading -->')
    body_blocks.append(f'<h2>{title}</h2>')
    body_blocks.append('<!-- /wp:heading -->')
    body_blocks.append('')
    # content paragraphs — already in wp:paragraph blocks or raw HTML
    body_blocks.append(body_html)
    body = '\n'.join(body_blocks)

    return f'''<!--
WordPress Post Import
Title: {title}
Category: disease-science
Tags: {tags}
Excerpt: {excerpt}
-->
{body}
'''


# ═══════════════════════════════════════════════════════════════
# ARTICLE DEFINITIONS  (each returns (num, slug, title, cat, tags, excerpt, body))
# ═══════════════════════════════════════════════════════════════

def all_articles():
    arts = []
    n = [15]  # mutable counter starting after 14

    def a(slug, title, tags, excerpt, body):
        num_str = f'{n[0]:02d}'
        arts.append((num_str, slug, title, tags, excerpt, body))
        n[0] += 1

    # ── Group 1: 症状自查 (keywords #2,4,5,7,8,9,12,13,14 — #1,3,6,10,11,15 covered) ──
    a('yingdu-bugou-shi-yangwei-ma', '硬度不够算阳痿吗',
      '硬度不够, 阳痿, ED自测, 勃起硬度分级, EHS',
      '硬度不够不一定就是阳痿。本文用EHS硬度分级帮您判断：什么程度的硬度下降需要就医，什么情况只是暂时的疲劳状态。',
      '''<!-- wp:paragraph -->
<p>"最近硬度不够，是不是阳痿了？"这是门诊中最常见的问题之一。答案是：<strong>不一定。</strong>硬度下降和阳痿（ED）之间有一个重要的"灰色地带"——关键看三点：持续时间、发生频率、晨勃状态。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>先用EHS硬度分级自我对照</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>国际通用的EHS（Erection Hardness Score）将勃起硬度分为4级：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>1级（豆腐）</strong>：阴茎胀大但不硬——这是明确的ED信号</li>
<li><strong>2级（剥皮香蕉）</strong>：有硬度但不足以插入——中度ED</li>
<li><strong>3级（带皮香蕉）</strong>：可以插入但不够坚挺——轻度ED或亚健康状态</li>
<li><strong>4级（黄瓜）</strong>：完全坚挺——正常</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>如果您长期处于1-2级，建议就医。如果只是偶尔3级、多数时候4级，可能是疲劳或心理因素，先调整生活方式观察。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>三个判断标准</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>持续时间</strong>：偶尔一两次（<1个月）→ 观察；持续超过3个月 → 就医</li>
<li><strong>发生频率</strong>：<25%的性生活受影响 → 可能正常波动；>50% → 建议评估</li>
<li><strong>晨勃状态</strong>：晨勃正常 → 偏向心理性；晨勃也消失 → 提示器质性</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>最重要的一条：</strong>不要自己吓自己。很多男性因为一两次"表现不佳"就陷入焦虑→硬度更差→更焦虑的恶性循环。如果确实担心，到正规医疗机构做个IIEF-EF量表评估就清楚了。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>硬度下降是身体发出的信号——可能是疲劳、可能是血管问题的早期预警、也可能只是心理压力。无论哪种情况，科学评估比盲目焦虑更有用。长沙地区患者可预约面诊，叶龙觉医生为您做专业评估。</p>
</div>'''),

    a('fangshi-zhongtu-piruan', '最近房事中途疲软怎么回事',
      '中途疲软, 勃起维持困难, 静脉性ED, ED原因',
      '房事中途疲软是静脉性ED的典型表现——血液"留不住"。也可能与心理因素、药物、疲劳有关。本文帮您分析可能的原因和应对方案。',
      '''<!-- wp:paragraph -->
<p>门诊中经常遇到这样的描述："刚开始还好好的，做到一半就软了"。这种"中途疲软"在医学上称为<strong>勃起维持困难</strong>，是ED（勃起功能障碍）的一种表现形式，通常指向特定病因。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>最可能的原因：静脉闭塞功能障碍</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>正常勃起时，白膜会压迫引流静脉，将血液"锁"在海绵体内。如果这个"阀门"出了问题——血液进去了又流出来——就会表现为<strong>勃起快、软得也快</strong>。常见诱因：糖尿病海绵体纤维化、Peyronie病（阴茎硬结症）、年龄相关的白膜弹性下降、长期吸烟导致的微血管损伤。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>其他可能原因</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>心理因素</strong>：表现焦虑——前戏时正常，正式"上场"时紧张导致交感神经过度兴奋</li>
<li><strong>药物影响</strong>：某些降压药、抗抑郁药（SSRI类）可影响勃起维持</li>
<li><strong>睾酮偏低</strong>：性欲和勃起维持都需要足够的雄激素支撑</li>
<li><strong>疲劳/酒精</strong>：一过性的，消除诱因后恢复</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>怎么办？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>首先区分是一过性还是持续性的——如果<strong>连续3个月、>50%的性生活都出现中途疲软</strong>，建议就医。诊断手段首选阴茎彩色多普勒超声（CDDU），可精确评估动脉供血和静脉闭塞功能。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>治疗方面，如果是血管性因素，Renova低能量冲击波可通过促进血管新生改善海绵体血供，从根源上增强勃起维持能力。配合盆底肌训练（凯格尔运动）可进一步增强静脉闭塞机制。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生总结</h2>
<p>"做到一半软了"不要硬扛，也不要觉得不好意思。这很可能是一个可以解决的问题——前提是找到正确的原因。长沙地区患者可预约叶龙觉医生面诊，明确病因后针对性治疗。</p>
</div>'''),

    a('yingdu-fenji-panduan', '硬度分级1-4级怎么判断',
      'EHS硬度分级, 勃起硬度自测, 阳痿自测',
      '国际EHS勃起硬度分级（1-4级）是判断ED严重程度的简单方法。1级豆腐、2级剥皮香蕉、3级带皮香蕉、4级黄瓜——您在哪个级别？',
      '''<!-- wp:paragraph -->
<p>EHS（Erection Hardness Score）勃起硬度分级是国际上最常用的ED自我评估工具，简单直观。了解自己的硬度级别，是决定是否需要就医的第一步。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>EHS四级硬度详解</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>EHS 1级（豆腐级）</strong>：阴茎有胀大感，但完全没有硬度，无法插入。这是重度ED的典型表现，通常伴随晨勃消失。建议尽快就医评估血管功能。</li>
<li><strong>EHS 2级（剥皮香蕉级）</strong>：有一定硬度，但不足以完成插入。属于中度ED，可能勉强可以插入但体验差。如果持续>3个月，需要就医。</li>
<li><strong>EHS 3级（带皮香蕉级）</strong>：硬度可完成插入，但不够坚挺，可能在过程中变软。属于轻度ED或亚临床ED。很多人处于这个阶段却"觉得还行"而拖延就医——恰恰是治疗黄金期。</li>
<li><strong>EHS 4级（黄瓜级）</strong>：完全坚挺，勃起充分。这是正常状态。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>结合IIEF-EF量表更准确</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>EHS只是单一维度。更全面的评估应使用IIEF-EF（国际勃起功能指数-勃起功能域），包含6个问题，评估勃起频率、硬度、维持能力、性交满意度等维度。总分30分：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>26-30分：正常</li>
<li>17-25分：轻度ED</li>
<li>8-16分：中度ED</li>
<li>≤7分：重度ED</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>关键提醒：</strong>EHS 3级+IIEF-EF 17-25分是<strong>冲击波治疗效果最好的阶段</strong>。Reisman等（2015）研究显示，轻中度血管性ED有效率高达90%以上。如果等到1-2级再治疗，修复难度会大很多。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生建议</h2>
<p>如果您长期处于EHS 2-3级，建议尽早做一次专业评估。越早干预，修复效果越好。电话预约：15909415555。</p>
</div>'''),

    a('buneng-wanquan-boqi', '不能完全勃起是怎么回事',
      '不能完全勃起, 勃起不全, ED原因, 硬度不够',
      '不能完全勃起（部分勃起）可能是血管性、神经性、内分泌性ED的早期表现，也可能只是暂时的心理或疲劳因素。本文分析各种可能性及应对方法。',
      '''<!-- wp:paragraph -->
<p>"能硬，但硬不到位"——这是很多男性在门诊中的描述。医学上叫"部分勃起"或"勃起不全"，通常对应EHS硬度分级的2-3级。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>先排除三个"假警报"</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>疲劳/睡眠不足</strong>：睾酮在深度睡眠时分泌，连续睡眠<5小时可导致睾酮一过性下降10%-15%。补觉后通常恢复。</li>
<li><strong>酒精</strong>：酒精是中枢神经抑制剂，即使没有醉，一两杯也可能使勃起硬度打折扣。</li>
<li><strong>心理压力</strong>：工作压力、关系紧张、表现焦虑——大脑处于"战斗模式"，副交感神经被抑制。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>如果持续存在，需要考虑的医学原因</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>血管内皮功能障碍</strong>：最常见原因。血管内皮无法产生足够的一氧化氮（NO），海绵体动脉扩张不足，血流进不来。这是高血压、高血脂、糖尿病、吸烟等损害血管的后果。</li>
<li><strong>睾酮偏低</strong>：睾酮是NO合成的上游调控因子。睾酮低→NO少→硬度差。</li>
<li><strong>神经传导问题</strong>：糖尿病神经病变、腰椎问题等导致勃起信号"传输不良"。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>怎么办？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>① 改善生活方式2-4周（规律睡眠+运动+减压），观察是否改善<br>② 如无改善，到正规医院做<strong>IIEF-EF量表+血糖血脂性激素+必要时CDDU</strong>检查<br>③ 明确病因后针对性治疗。血管性因素用Renova冲击波促进血管新生；内分泌因素补充睾酮；心理因素通过认知行为治疗</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>不能完全勃起是最容易被忽视的ED早期信号。很多人觉得"还能用"就不管，等拖到完全硬不起来再就医，修复难度已经增加。早期干预效果好很多。</p>
</div>'''),

    a('yingyihui-jiuruan', '硬一会就软了是什么问题',
      '硬一会就软了, 勃起维持困难, 静脉漏, ED治疗',
      '"刚开始硬，几分钟就软了"——这是勃起维持困难，最常见原因是静脉闭塞功能障碍（静脉漏）。也可能与焦虑、药物、睾酮低有关。了解原因才能对症解决。',
      '''<!-- wp:paragraph -->
<p>门诊中，"硬一会就软了"是高频描述之一。它在医学上称为<strong>勃起维持障碍</strong>——勃起可以启动，但不能维持到性交完成。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>核心原因：静脉闭塞机制失灵</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>勃起需要两个条件同时满足：<strong>动脉血快速流入 + 静脉血被"锁住"</strong>。正常勃起时，海绵体充盈血液后膨胀，压迫白膜下静脉使其闭塞——血液只进不出。如果这个"阀门"失灵，血液进得快出得也快，就表现为硬一会就软。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>谁容易出现静脉漏？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>糖尿病患者</strong>：高血糖导致海绵体平滑肌纤维化，白膜弹性下降</li>
<li><strong>Peyronie病患者</strong>：白膜斑块失去正常弹性</li>
<li><strong>长期吸烟者</strong>：微血管损伤导致海绵体组织缺氧</li>
<li><strong>中老年男性</strong>：年龄相关的白膜胶原化</li>
<li><strong>盆腔手术/外伤后</strong></li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>诊断与治疗</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>诊断金标准</strong>是阴茎彩色多普勒超声（CDDU），关键指标：EDV（舒张末期流速）>5cm/s提示静脉闭塞功能障碍。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>治疗方案</strong>：轻度可通过盆底肌训练（凯格尔运动）增强球海绵体肌和白膜张力改善。中重度可考虑Renova冲击波治疗促进血管和组织修复。严重静脉漏可能需要手术（静脉结扎术）。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生总结</h2>
<p>"硬一会就软"通常不是简单的"累了"或"心理作用"，而是有明确的病理基础。建议先做CDDU检查明确诊断，再决定治疗方案。长沙地区可预约叶龙觉医生面诊。</p>
</div>'''),

    a('turan-yingbuqilai', '突然硬不起来了怎么回事',
      '突然硬不起来, 急性ED, 心理性ED, 器质性ED',
      '突然发生的勃起困难——区别于渐进性ED——往往有明确的诱因。可能是心理应激、药物变化、急性疾病或损伤。找到诱因是关键。',
      '''<!-- wp:paragraph -->
<p>"之前一直好好的，突然就不行了"——这种<strong>急性起病的ED</strong>有其独特的临床意义。与缓慢进展的ED不同，突然发生往往指向明确的诱因。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>突然ED vs 渐进ED：为什么起病方式很重要？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>渐进性ED</strong>（数月-数年逐渐加重）→ 更可能是器质性病变（血管老化、糖尿病进展等）</li>
<li><strong>突发性ED</strong>（几天-几周内突然出现）→ 更可能是心理因素、药物变化、或急性事件</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>突然硬不起来的常见诱因</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>急性心理应激</strong>：一次失败的性经历→表现焦虑→恶性循环。这是最常见的突发ED原因。</li>
<li><strong>新加药物</strong>：开始服用降压药（尤其β阻滞剂）、抗抑郁药（SSRI）、非那雄胺等。停药或换药后通常恢复。</li>
<li><strong>急性疾病</strong>：重感冒、新冠感染后、手术麻醉后——身体应激状态，通常1-4周恢复。</li>
<li><strong>关系危机</strong>：出轨被发现、激烈争吵、离婚威胁——情感冲击直接影响性功能。</li>
<li><strong>过量饮酒/物质滥用</strong></li>
<li><strong>盆底损伤</strong>：骑自行车长途、会阴部外伤</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>最重要的自检方法</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>晨勃还在不在？</strong>如果晨勃正常→大概率是心理性，通过心理调整或短期小剂量PDE5i打破焦虑循环即可恢复。如果晨勃也消失→需要进一步检查器质性原因。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>突发ED如果2-4周内不自行恢复，建议就医。关键不是"吃什么药"，而是找到诱因并去除。很多人因为一次突发ED而陷入恐慌，反而加重了问题。</p>
</div>'''),

    a('ban-ying-bu-ying-suan-ED-ma', '半硬不硬算ED吗',
      '半硬不硬, 轻度ED, EHS 3级, ED早期信号',
      '半硬不硬（EHS 3级）可能已经是轻度ED了。很多人觉得"还行"而忽视，却错过了最佳治疗窗口。本文帮您判断该阶段是否应该就医。',
      '''<!-- wp:paragraph -->
<p>"说硬吧又不够硬，说不硬吧又能用"——EHS 3级（半硬不硬）是最容易被忽视的ED阶段，却恰恰是<strong>治疗效果最好的黄金窗口</strong>。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>半硬不硬 = 轻度ED</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>按照IIEF-EF量表标准，如果您的得分在17-25分范围内，就属于轻度ED。具体表现：可以完成插入，但硬度不够满意；有时能维持勃起到结束，有时不能。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>为什么要重视这个阶段？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>轻度ED是<strong>血管内皮功能障碍的早期信号</strong>。此时血管损伤还处于可逆阶段——内皮细胞功能下降但尚未出现结构性病变。Reisman等（2015）研究显示：轻中度ED进行Renova冲击波治疗，有效率最高——因为血管新生潜力还很大，修复效果好。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>如果拖到重度ED（EHS 1-2级），海绵体可能出现纤维化，修复难度大幅增加。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>半硬不硬阶段该怎么办？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>第一步</strong>：改善生活方式（有氧运动+戒烟限酒+充足睡眠）1个月</li>
<li><strong>第二步</strong>：如无改善，做IIEF-EF量表+基础检查</li>
<li><strong>第三步</strong>：如果是血管性ED，尽早做Renova冲击波治疗——这个阶段效果最好</li>
</ul>
<!-- /wp:list -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生总结</h2>
<p>"半硬不硬"不是小事，是身体在提醒您：血管需要关注了。趁还在可逆阶段，积极干预的效果远好于拖延。长沙地区可预约免费评估。</p>
</div>'''),

    a('zenme-panduan-shibushi-yangwei', '怎么判断自己是不是阳痿',
      '阳痿自测, IIEF-EF量表, ED自我评估, EHS硬度',
      '判断自己是否阳痿不能凭感觉，需要科学的评估工具。本文介绍IIEF-EF国际标准量表和EHS硬度分级，帮您客观评估勃起功能。',
      '''<!-- wp:paragraph -->
<p>很多男性因为一两次"表现不好"就给自己扣上"阳痿"的帽子，结果自我暗示真的导致了持续性ED。判断是否阳痿，需要<strong>科学工具，不是感觉</strong>。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>第一步：EHS硬度快速筛查</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>回顾最近一个月的勃起情况，以最典型的状态判断：1级（胀大无硬度）或2级（有硬度不能插入）持续>1个月 → 很可能ED。3级（可插入不够硬）→ 轻度ED可能。4级 → 正常。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>第二步：IIEF-EF国际标准量表</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>IIEF-EF包含6个问题，每题1-5分，总分30分。这是全球公认最权威的ED评估工具：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>过去4周，您在性生活中能勃起的频率？</li>
<li>勃起硬度足以插入的频率？</li>
<li>能维持勃起到性交完成的频率？</li>
<li>维持勃起到性交结束有多困难？</li>
<li>尝试性交时对勃起有多自信？</li>
<li>对勃起功能的整体满意度？</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>评分标准：</strong>26-30正常 | 22-25轻度 | 17-21轻中度 | 11-16中度 | ≤10重度</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>第三步：晨勃观察</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>晨勃是否正常是鉴别心理性和器质性ED的关键线索——晨勃正常提示心理性；晨勃减少或消失提示器质性。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>重要提醒：</strong>自测量表不能替代专业诊断。如果自测结果提示ED可能性大，应到正规医疗机构完成专业评估。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生建议</h2>
<p>不要百度一下就给自己"确诊"。来医院做一次IIEF-EF+基础检查，半小时就能明确。预约电话：15909415555。</p>
</div>'''),

    a('ED-yanzhongchengdu-zenmefen', 'ED严重程度怎么分',
      'ED严重程度分级, IIEF-EF评分, 轻度ED, 中度ED, 重度ED',
      'ED分为轻度、中度、重度三级，主要依据IIEF-EF评分。不同严重程度的治疗策略截然不同——轻度可能冲击波即可，重度可能需要综合方案。',
      '''<!-- wp:paragraph -->
<p>ED不是一个"有或没有"的二分法诊断，而是有<strong>轻度→中度→重度</strong>的连续谱系。不同严重程度对应不同的治疗策略，也决定了治疗效果的上限。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>IIEF-EF评分：国际标准分级</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>正常（26-30分）</strong>：勃起功能良好，无需干预</li>
<li><strong>轻度ED（22-25分）</strong>：偶尔硬度不足或维持困难。EHS通常3-4级。是治疗黄金期——冲击波有效率最高（>90%）</li>
<li><strong>轻中度ED（17-21分）</strong>：约半数性生活中出现困难。EHS通常2-3级。冲击波有效率约80-90%</li>
<li><strong>中度ED（11-16分）</strong>：大多数性生活有困难。EHS通常2级。冲击波有效率约60-80%，可能需要联合用药</li>
<li><strong>重度ED（≤10分）</strong>：几乎不能勃起或完全不能。EHS通常1-2级。需要综合治疗（冲击波+药物+生活方式），部分患者需评估手术</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>为什么要分级？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>不同严重程度的治疗目标不同：轻度→目标是"治愈"（恢复正常功能）；中度→目标是显著改善（减少药物依赖）；重度→目标是可管理（能完成性生活，即使需要辅助手段）。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>越早干预，治疗天花板越高。</strong>轻度ED做冲击波，大概率恢复正常；重度ED即使做冲击波，可能只能从重度改善到中度。所以不要拖。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生总结</h2>
<p>ED的严重程度决定了治疗的空间。轻度ED是可以"逆转"的窗口期——过了这个窗口，修复难度会越来越大。如果您不确定自己处于哪个阶段，来做个免费评估。</p>
</div>'''),

    # ── Group 2: 病因探索 (keywords #17,18,19,20,23,26,27,28,29,30 — #16,21,22,24,25 covered) ──
    a('tangniaobing-daozhi-yangwei', '糖尿病会导致阳痿吗',
      '糖尿病ED, 糖尿病阳痿, 高血糖勃起功能',
      '糖尿病是ED最常见的器质性病因之一。糖尿病患者ED发病率高达50%-75%，且比非糖尿病患者早10-15年出现。控制血糖+Renova冲击波是有效的治疗组合。',
      '''<!-- wp:paragraph -->
<p><strong>会，而且是ED最常见、最重要的器质性病因之一。</strong>糖尿病患者的ED发病率是普通人群的3-4倍，达50%-75%，且发病年龄比非糖尿病患者提前10-15年。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>糖尿病损害勃起功能的三条通路</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>血管损伤（最主要）</strong>：高血糖导致血管内皮细胞氧化应激和糖基化终末产物（AGEs）堆积，损害NO合成和释放。海绵体动脉无法充分扩张，血液进不来。这是"血管性ED"的典型机制。</li>
<li><strong>神经病变</strong>：长期高血糖损害周围神经，包括支配阴茎勃起的自主神经（cavernous nerves）。即使血管还通畅，"指令信号"传不到阴茎。</li>
<li><strong>海绵体纤维化</strong>：AGEs诱导TGF-β1表达，促使海绵体平滑肌被胶原纤维替代——失去了弹性，海绵体无法充分扩张，静脉闭塞功能下降。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>糖尿病ED能治吗？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>能，但需要综合方案：</strong></p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>严格控制血糖</strong>：HbA1c<7%是基础，否则任何治疗都大打折扣</li>
<li><strong>Renova冲击波</strong>：通过促进VEGF表达和血管新生改善海绵体微循环，对糖尿病ED患者的血管性因素有针对性修复作用</li>
<li><strong>联合PDE5i</strong>：部分糖尿病ED患者需要冲击波+长期小剂量他达拉非（5mg每日）联合方案</li>
<li><strong>生活方式</strong>：运动+饮食控制+戒烟，综合管理</li>
</ul>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>糖尿病ED的治疗关键在于"早"。一旦发现勃起功能下降，不要只吃降糖药了事，而要同步关注血管健康。长沙地区糖尿病ED患者可预约叶龙觉医生评估综合治疗方案。</p>
</div>'''),

    a('gaoxueya-daozhi-ED', '高血压会导致ED吗',
      '高血压ED, 降压药ED, 血管性ED',
      '高血压与ED互为因果——高血压损害血管导致ED，部分降压药也可能加重ED。但好消息是：控制好血压本身就是改善ED的第一步。',
      '''<!-- wp:paragraph -->
<p><strong>会。</strong>高血压是ED的独立危险因素。研究显示：高血压患者ED发病率是血压正常者的1.5-2倍。而且ED往往是高血压最早的"并发症信号"。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>高血压如何导致ED？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>核心机制是<strong>血管内皮功能障碍</strong>。长期高血压导致：血管内皮细胞受损→NO（一氧化氮）合成减少→血管平滑肌舒张能力下降→海绵体动脉无法充分扩张→勃起硬度不足。阴茎动脉比冠状动脉更细，所以勃起功能下降往往比冠心病早出现2-5年——<strong>ED是心血管疾病的"预警信号"</strong>。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>降压药的影响：不是所有降压药都一样</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>对勃起影响较大的</strong>：噻嗪类利尿剂、非选择性β阻滞剂（如普萘洛尔）</li>
<li><strong>影响较小或中性</strong>：ACEI（如培哚普利）、ARB（如缬沙坦、厄贝沙坦）——甚至有轻度改善勃起功能的作用</li>
<li><strong>部分改善</strong>：选择性β1阻滞剂（如奈必洛尔——可促进NO释放）</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>关键：</strong>切勿因为担心ED而擅自停降压药！血压失控对血管的损害远大于降压药对ED的影响。如果怀疑降压药导致ED，应与医生沟通更换药物种类。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生建议</h2>
<p>高血压+ED → 首先把血压控制在正常范围，其次评估血管功能，必要时做Renova冲击波促进血管内皮修复。两类问题同步管理效果才最好。</p>
</div>'''),

    a('shouyin-daozhi-yangwei', '手淫会导致阳痿吗',
      '手淫阳痿, 自慰ED, 过度手淫, 色情ED',
      '适度手淫通常不会导致阳痿，但过度频繁或伴随色情成瘾时，可能通过多种机制影响勃起功能。了解"度"在哪里很关键。',
      '''<!-- wp:paragraph -->
<p>这是门诊和网络上最高频的问题之一。答案是：<strong>适度手淫一般不会导致阳痿；过度频繁或伴随色情成瘾时，可能间接影响勃起功能。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>什么情况下手淫可能影响勃起？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>过度频繁（每天多次）</strong>：射精后催乳素升高、多巴胺下降，导致短期性欲和勃起能力下降。这是暂时性的"生理不应期"，不是永久ED。减少频率即可恢复。</li>
<li><strong>色情内容诱导的ED（PIED）</strong>：长期观看高强度色情内容，大脑奖赏系统对正常性刺激"脱敏"。表现为：看片可以硬，与真实伴侣却硬不起来。这不是器质性ED，而是大脑多巴胺系统功能性失调。</li>
<li><strong>手淫方式与真实性交差异</strong>：手淫的刺激强度远大于性交——习惯了"高压水枪"后，"花洒"就不够劲了。</li>
<li><strong>罪恶感与焦虑</strong>：对手淫有负罪感→紧张焦虑→交感神经过度兴奋→勃起困难。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>如何判断手淫是否影响了你？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>简单测试：<strong>停止手淫2-4周，观察晨勃和真实性交时的表现。如果明显改善→问题在习惯；如果无改善→需要就医排查器质性原因。</strong></p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>手淫本身不是"原罪"。适度自慰（每周2-3次）是正常的性行为，不会损害勃起功能。但如果已经出现勃起问题，减少频率+停止色情刺激是很好的自我调整起点。</p>
</div>'''),

    a('yali-dadao-hui-daozhi-yangwei-ma', '压力大会导致阳痿吗',
      '压力ED, 心理性ED, 焦虑勃起困难, 交感神经',
      '压力大是年轻人ED最常见的原因之一。慢性压力通过持续激活交感神经系统，直接"刹车"勃起功能。了解压力→ED的机制，学会打破恶性循环。',
      '''<!-- wp:paragraph -->
<p><strong>会，而且是年轻人ED中最常见的原因。</strong>在35岁以下的ED患者中，心理因素（压力位居首位）占比超过60%。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>压力如何"杀"死勃起？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>勃起需要<strong>副交感神经主导</strong>（"放松"模式）。压力持续激活<strong>交感神经</strong>（"战斗或逃跑"模式），两种神经系统的关系就像油门和刹车——交感神经兴奋就是在踩刹车。长期压力让身体处于"随时准备战斗"状态，副交感神经被持续抑制，勃起自然困难。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>压力导致ED的恶性循环</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>工作/生活压力 → 一次勃起不理想 → "表现焦虑" → 下次更紧张 → 勃起更差 → 自我怀疑 → 持续ED。这个循环中，<strong>最初的器质性问题可能很小或不存在，但焦虑的不断叠加终将导致真实的ED。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>如何打破循环？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>运动是天然减压药</strong>：每周150分钟中等强度有氧运动，可降低皮质醇、提升NO水平。研究显示运动改善ED的效果与低剂量PDE5i相当。</li>
<li><strong>正念与冥想</strong>：降低交感神经张力，帮助恢复副交感神经主导</li>
<li><strong>短期小剂量PDE5i</strong>：成功的性经历能打破焦虑循环——"原来我是可以的"</li>
<li><strong>必要时心理咨询</strong></li>
</ul>
<!-- /wp:list -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生总结</h2>
<p>压力和ED的关系不是"矫情"——这是真实的生理机制。如果您正处于高压+ED的状态，先不要急着吃补药，从减压开始往往有意想不到的效果。</p>
</div>'''),

    a('yangwei-shi-shenxu-ma', '阳痿是肾虚引起的吗',
      '阳痿肾虚, ED中医, 肾虚阳痿, ED误区',
      'ED不只是"肾虚"。根据中医辨证，ED的病因包括肝郁、湿热、血瘀、阴虚、阳虚等多种证型，盲目补肾可能适得其反。现代医学视角下，血管性因素才是最核心的病因。',
      '''<!-- wp:paragraph -->
<p>"阳痿就是肾虚"是中国社会最根深蒂固的ED认知误区之一。实际上，<strong>这只说对了一小部分——肾虚（中医概念）只是ED多种病因中的一种，且远不是最常见的。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>中医视角：ED ≠ 肾虚</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>中医将ED（"阳痿"或"筋痿"）的病因分为至少五种证型：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>肝气郁结（最常见于年轻人）</strong>：压力、情绪不畅导致肝失疏泄，气血不能充盈宗筋。表现为情绪紧张时ED加重。</li>
<li><strong>湿热下注（中年常见）</strong>：饮食不节、久坐少动，湿热蕴结下焦。常伴阴囊潮湿、小便黄。</li>
<li><strong>血瘀阻络（糖尿病/高血脂患者）</strong>：血脉不通，瘀血阻络。对应现代医学的血管性ED。</li>
<li><strong>肾阳虚</strong>：畏寒怕冷、腰膝酸软。这是老百姓最熟知的"肾虚ED"，但在临床上比例不高。</li>
<li><strong>肾阴虚</strong>：五心烦热、盗汗、口干。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>盲目补肾的危害</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>如果是肝郁型却去补肾阳（吃鹿茸、淫羊藿等），可能越补越上火、越补越焦虑。如果是湿热型去补肾，等于"火上浇油"。如果是血瘀型（血管性ED），<strong>"补肾能治好血管堵塞吗？"——当然不能。</strong></p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生总结</h2>
<p>中医的"肾虚"概念与现代医学的"ED"不是一一对应的。盲目吃补药（尤其是来路不明的"保健品"）可能延误真正的病因诊治。叶龙觉医生是中医院校科班出身，擅长中西医结合辨证论治。</p>
</div>'''),

    a('xinli-yinsu-daozhi-yangwei', '心理因素会导致阳痿吗',
      '心理性ED, 表现焦虑, 心理因素阳痿, 心因性ED',
      '心理因素是ED的常见原因，尤其在40岁以下男性中占60%以上。表现焦虑、抑郁、关系问题、色情成瘾——这些心理因素有明确的生理机制导致勃起困难。',
      '''<!-- wp:paragraph -->
<p><strong>会，而且是年轻ED患者中最重要的病因。</strong>心理性ED并非"假ED"或"矫情"——它有明确的生理通路：心理因素→交感神经系统过度激活→阴茎海绵体平滑肌无法松弛→勃起失败。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>心理性ED的四种常见类型</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>表现焦虑</strong>："上次没成，这次能行吗？"→越是担心，"刹车"踩得越紧。这是最常见的心理性ED，典型特征：晨勃正常、自慰正常，但与伴侣时出问题。</li>
<li><strong>抑郁相关性ED</strong>：抑郁降低性欲和愉悦感→勃起功能下降。注意：SSRI类抗抑郁药也可能加重ED，需要与精神科医生沟通调整。</li>
<li><strong>关系问题性ED</strong>：伴侣间矛盾、缺乏情感连接、或性欲差异导致"性趣"下降。</li>
<li><strong>色情诱导ED（PIED）</strong>：大脑对正常性刺激的"脱敏"——屏幕上的可以，真人不行。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>心理性ED的特点：晨勃是晴雨表</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>心理性ED vs 器质性ED的简单鉴别</strong>：晨勃正常→更可能是心理性；晨勃也消失→更可能是器质性。因为睡眠时没有"表现焦虑"，大脑的"刹车"松开了。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>心理性ED的治疗</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>核心是<strong>打破焦虑-失败的恶性循环</strong>。策略：短期小剂量PDE5i→成功经历→重建自信→停药观察。配合心理治疗/性治疗、正念减压、伴侣沟通。多数心理性ED预后良好。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>心理性ED不是"想开点就好了"那么简单——它是需要专业干预的医学问题。好消息是治疗效果通常很好。</p>
</div>'''),

    a('qianliexianyan-yinqi-yangwei', '前列腺炎会引起阳痿吗',
      '前列腺炎ED, 慢性前列腺炎阳痿, 前列腺与性功能',
      '前列腺炎与ED的关系复杂——前列腺炎本身可能不直接致ED，但相关的疼痛、焦虑、排尿症状可能间接影响勃起。了解两者的真实关系很重要。',
      '''<!-- wp:paragraph -->
<p>这是男科门诊中非常常见的问题。答案是：<strong>前列腺炎（尤其是慢性前列腺炎/慢性盆腔疼痛综合征CP/CPPS）与ED之间的关系是间接的，而非直接的器质性损害。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>前列腺炎如何间接影响勃起？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>盆腔疼痛的干扰</strong>：会阴部、睾丸、阴茎疼痛不适→性欲下降→勃起启动困难</li>
<li><strong>焦虑与抑郁</strong>：CP/CPPS患者焦虑和抑郁发生率显著升高，心理因素→ED</li>
<li><strong>排尿症状的影响</strong>：尿频、尿急、排尿不畅→夜间睡眠中断→疲劳→睾酮下降→ED</li>
<li><strong>对性能力的担忧</strong>：很多患者认为"前列腺有病就不能过性生活"→主动回避→功能下降</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>几个重要的事实</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>前列腺液是精液的组成部分，前列腺炎不影响勃起的解剖结构（海绵体和血管）</li>
<li>治疗前列腺炎后，很多患者的ED随之改善——说明是功能性而非器质性</li>
<li>不要把ED归咎于前列腺炎而忽视真正的病因（血管、内分泌、心理）</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>建议：</strong>如果同时有前列腺炎和ED，应分别评估、综合治疗。不要认为"只要治好了前列腺炎，ED自然就好"——这两者的病因路径不完全重合。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>前列腺炎和ED的"共生"关系往往与心理因素和盆腔肌肉紧张有关。综合管理（药物+物理治疗+心理疏导）效果最好。</p>
</div>'''),

    a('changqi-chi-jiangyayao-huidaozhi-ED-ma', '长期吃降压药会导致ED吗',
      '降压药ED, 降压药副作用, 高血压ED, 降压药对性功能的影响',
      '部分降压药（尤其噻嗪类利尿剂和非选择性β阻滞剂）确实可能影响勃起功能。但血压失控对血管的伤害更大。重要的是区分不同降压药的影响，而不是因噎废食停药。',
      '''<!-- wp:paragraph -->
<p><strong>部分降压药确实可能影响勃起功能，但不同类型的降压药对ED的影响差异很大。</strong>更关键的是：高血压本身就会导致ED——因为长期高血压损害血管内皮。所以不能简单归咎于"药吃坏了"。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>降压药对ED的影响排名</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>影响较大</strong>：噻嗪类利尿剂（氢氯噻嗪等）→ED发生率约15-20%；非选择性β阻滞剂（普萘洛尔）→ED约10-15%。机制：利尿剂降低血容量影响勃起血流；β阻滞剂抑制交感神经也同时影响勃起的神经调控。</li>
<li><strong>影响中等</strong>：选择性β1阻滞剂（阿替洛尔、美托洛尔）→ED约5-10%</li>
<li><strong>影响小/中性</strong>：ACEI（培哚普利等）、ARB（缬沙坦、厄贝沙坦等）→ED风险与安慰剂无显著差异，甚至可能轻微改善</li>
<li><strong>可能改善</strong>：奈必洛尔（新一代β阻滞剂）→可促进NO释放，对勃起功能有益</li>
</ul>
<!-- /wp:header -->

<!-- wp:heading {"level":3} -->
<h3>如果您怀疑降压药导致ED</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>千万不要擅自停药！</strong>血压反弹可导致心脑血管事件</li>
<li>记录ED出现的时间与药物变更之间的关系</li>
<li>与心内科医生沟通，评估是否可以换用对勃起影响较小的ACEI/ARB类或奈必洛尔</li>
<li>如果是高血压本身导致的血管性ED：控制血压是基础，Renova冲击波可促进血管修复</li>
</ul>
<!-- /wp:list -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>降压药和ED之间的关系，通常被夸大了。更常见的情况是：高血压损伤了血管→出现ED→患者开始吃降压药→ED继续→被归咎于药物。正确做法：控制血压的同时评估血管功能，必要时做冲击波治疗。</p>
</div>'''),

    a('feipang-daozhi-yangwei', '肥胖会导致阳痿吗',
      '肥胖ED, 体重阳痿, BMI ED风险, 内脏脂肪性功能',
      '肥胖是ED的独立危险因素。BMI每增加1个单位，ED风险增加约5%。肥胖通过降低睾酮、损害血管内皮、增加炎症三条通路影响勃起功能。减肥本身就是治疗ED的有效手段。',
      '''<!-- wp:paragraph -->
<p><strong>会。</strong>肥胖是ED的独立危险因素。研究显示：BMI>30的男性ED风险是正常体重者的2倍以上。BMI每增加1个单位，ED风险增加约5%。而且<strong>腹型肥胖（内脏脂肪）对勃起功能的危害最大</strong>。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>肥胖导致ED的三条通路</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>睾酮下降</strong>：脂肪组织中的芳香化酶将睾酮转化为雌激素。肥胖男性睾酮水平显著低于正常体重者，雌激素/睾酮比例失调→性欲和勃起功能双重受损。</li>
<li><strong>血管内皮损伤</strong>：内脏脂肪释放大量炎症因子（TNF-α、IL-6等）和游离脂肪酸→胰岛素抵抗→血管内皮功能障碍→NO生物利用度下降→勃起困难。</li>
<li><strong>动脉粥样硬化</strong>：肥胖通常伴高血脂和高血压，进一步损害阴茎动脉。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>减肥对ED的改善作用——有循证证据</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>一项纳入110名肥胖ED患者的研究（Esposito et al., JAMA 2004）显示：通过生活方式干预减重≥10%的患者，IIEF-EF评分平均提升3分以上，约1/3的患者勃起功能完全恢复正常。<strong>运动和减重是治疗ED最"便宜"且有效的"药物"。</strong></p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生总结</h2>
<p>如果您BMI>28且出现了勃起问题，减肥可能是优先级最高的干预——不仅改善ED，还降低心血管疾病、糖尿病风险。冲击波治疗+生活方式干预联合效果最优。</p>
</div>'''),

    a('yaozhui-jianpan-boqi-yingxiang', '腰椎间盘突出会影响勃起吗',
      '腰椎ED, 椎间盘突出阳痿, 神经源性ED, 马尾神经',
      '腰椎间盘突出确实可能影响勃起功能——当突出的椎间盘压迫到支配阴茎的神经通路时。严重时（马尾综合征）需紧急手术，轻度压迫可通过康复治疗改善。',
      '''<!-- wp:paragraph -->
<p><strong>会，但不是所有腰椎间盘突出都会影响勃起。</strong>关键在于突出的位置和压迫的对象。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>腰椎间盘突出如何影响勃起？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>支配勃起的神经来自骶髓（S2-S4节段），走行于椎管内的马尾神经中。如果腰椎间盘突出（最常见于L4-L5或L5-S1）压迫到马尾神经或其分支，就可能阻断或减弱勃起信号。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>需要警惕的危险信号</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>ED + 下肢麻木/无力</strong>：高度提示神经压迫</li>
<li><strong>ED + 大小便障碍</strong>：可能提示马尾综合征——需要紧急手术的急症</li>
<li><strong>ED + 会阴部麻木（"马鞍区"感觉减退）</strong>：同样需要紧急评估</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>怎么办？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>如果ED与腰椎问题有关，治疗重点在于解决神经压迫。轻度：理疗+康复训练+药物（神经营养、消炎）。中重度压迫：可能需要椎间盘摘除或减压手术。部分患者在腰椎手术后勃起功能得到改善。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>不要忽视：</strong>腰椎间盘突出伴ED可能是需要手术的信号，尤其是伴有下肢神经功能障碍时。但也不要过度恐慌——绝大多数腰椎间盘突出不会导致ED。</p>
<!-- /wp:paragraph -->

<div class="expert-note">
<h2>👨‍⚕️ 叶医生提示</h2>
<p>ED合并腰椎问题时，建议同时就诊男科和脊柱外科，明确神经压迫是否确实是ED原因。如果是压迫所致，解决压迫后ED可能自然改善。</p>
</div>'''),

    # ── I'll continue generating the remaining articles in subsequent batch calls to avoid hitting limits ──
    return arts

# ── Run ──
if __name__ == '__main__':
    articles = all_articles()
    created = 0
    for num_str, slug, title, tags, excerpt, body in articles:
        fname = f'{num_str}-{slug}.html'
        if slug in EXISTING or any(fname.endswith(f'-{slug}.html') for slug in EXISTING):
            continue
        # Check if slot already taken
        filepath = os.path.join(OUT, fname)
        content = make_article(num_str, slug, title, 'disease-science', tags, excerpt, body)
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        created += 1
        print(f'Created: {fname}')
    print(f'\nDone. {created} new articles created.')
