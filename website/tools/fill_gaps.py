# -*- coding: utf-8 -*-
"""Fill the remaining ~19 keyword gaps to reach 100 articles."""
import os

OUT = 'D:/cc/renova/website/renova-clinic/articles'

def make_article(slug, title, tags, excerpt, body):
    return f'''<!--
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
<p>本文仅供健康科普参考，不能替代专业医疗诊断。如有ED相关症状，建议到正规医疗机构就诊。长沙地区患者可预约叶龙觉医生面诊评估，电话15909415555。</p>
</div>
'''

articles = [
    # ── Group 1 gaps: #3, #6, #10, #11, #15 ──
    ('18-ying-bu-qilai-yuanyin', '硬不起来是什么原因',
     '硬不起来原因, 勃起困难原因, ED病因, 硬度不够原因',
     '硬不起来（勃起困难）的原因包括血管性、神经性、内分泌、心理性、药物性和生活方式六大类。了解病因是解决问题的第一步。',
     '''<!-- wp:paragraph -->
<p>"硬不起来"是很多男性最难启齿的困扰。从医学角度看，这不是一个单一疾病，而是多种病因导致的共同症状。了解真正的原因，才能找到正确的解决方案。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>硬不起来的六大原因</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>血管性（约70%）</strong>：阴茎血管功能异常——动脉供血不足（高血压/高血脂/糖尿病/吸烟损害血管）或静脉漏（血液留不住）。这是最常见的器质性ED病因。</li>
<li><strong>神经性</strong>：糖尿病神经病变、腰椎间盘突出、盆腔手术损伤勃起神经。信号通路出了问题。</li>
<li><strong>内分泌性</strong>：睾酮水平低下、高泌乳素血症、甲状腺功能异常、肥胖。激素是勃起的"燃料"。</li>
<li><strong>心理性</strong>：表现焦虑、抑郁、压力、色情成瘾——40岁以下最常见。好在晨勃通常正常。</li>
<li><strong>药物性</strong>：部分降压药、抗抑郁药、非那雄胺等可影响勃起。</li>
<li><strong>生活方式性</strong>：吸烟（ED风险1.5-2倍）、缺乏运动、肥胖、熬夜（睾酮降10%-15%）。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>最重要的第一步：区分类型</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>晨勃正常+特定情境硬不起来</strong>→更可能是心理性；<strong>晨勃也消失+逐渐加重</strong>→更可能是器质性。最终诊断需要到医院做IIEF-EF量表+必要检查。找到病因才能对症治疗。</p>
<!-- /wp:paragraph -->'''),

    ('19-chenbo-zhengchang-xinli-qiqi', '晨勃正常但做爱时不行是心理还是器质性的',
     '晨勃正常ED, 心理性ED, 器质性ED鉴别, 表现焦虑',
     '晨勃正常但真实性交时勃起困难，高度提示心理性ED（表现焦虑）。原理：睡眠时没有"表现压力"，交感神经的"刹车"松开了。',
     '''<!-- wp:paragraph -->
<p><strong>晨勃正常但做爱时不行——这高度提示心理性ED。</strong>这是门诊中最常见、也最容易治疗的ED类型之一。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>晨勃是心理性ED的"晴雨表"</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>勃起需要<strong>副交感神经主导</strong>（放松模式）。睡眠时大脑完全放松，没有"表现压力"，如果血管和神经功能正常，就会有晨勃。醒来后面对真实性生活时，如果存在焦虑、紧张、"上次失败了这次能行吗"的担忧，交感神经（压力模式）就会被激活——相当于给勃起功能踩了"刹车"。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>简单判断标准：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>晨勃正常 + 自慰正常 + 真实性交困难</strong> → 几乎可以确定是心理性ED</li>
<li><strong>晨勃也消失 + 对所有情境都困难</strong> → 高度怀疑器质性ED（血管、神经、激素）</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>心理性ED的治疗——打破恶性循环</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>核心策略：<strong>重建成功经验。</strong>短期小剂量PDE5i→成功的性生活→重建自信→逐渐减药→脱离依赖。配合正念减压和伴侣沟通，多数心理性ED可完全恢复。</p>
<!-- /wp:paragraph -->'''),

    ('20-chenbo-xiaoshi-zhengchang-ma', '晨勃消失了正常吗',
     '晨勃消失, 晨勃减少, ED早期信号, 夜间勃起',
     '偶尔没有晨勃是正常的。但如果晨勃持续消失超过1个月，可能是器质性ED的早期信号，提示血管或激素可能已经出现问题。',
     '''<!-- wp:paragraph -->
<p>偶尔没有晨勃（如疲劳、熬夜、饮酒后）完全正常。但<strong>如果晨勃持续消失超过1个月，就值得关注了</strong>——它可能是器质性ED的早期预警信号。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>为什么晨勃是一个重要的健康指标？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>健康男性每晚有3-5次夜间勃起，每次持续20-40分钟。晨勃是最后一次夜间勃起醒来时刚好注意到的。夜间勃起需要<strong>正常的血管功能、神经传导、睾酮水平</strong>三者协同。如果晨勃长期消失，三者之中至少有一个出了问题。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>晨勃消失的常见原因</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>睾酮低下</strong>：40岁后睾酮下降是常见原因。可查血确认。</li>
<li><strong>血管内皮功能障碍</strong>：高血压、高血脂、糖尿病、吸烟损害血管，导致夜间勃起减少。</li>
<li><strong>睡眠质量差</strong>：打鼾、睡眠呼吸暂停（OSA）破坏REM睡眠期——夜间勃起主要发生的阶段。</li>
<li><strong>药物影响</strong>：某些降压药、抗抑郁药可抑制夜间勃起。</li>
<li><strong>心理压力</strong>：严重压力可能导致暂时性的晨勃消失。</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>如果晨勃已经持续1个月以上没有</strong>，建议到医院做一次检查（性激素+血糖血脂+必要时CDDU）。不要等到完全硬不起来再就医。</p>
<!-- /wp:paragraph -->'''),

    ('21-chenbo-jianshao-yuanyin', '晨勃减少了是什么原因',
     '晨勃减少, 睾酮下降, ED前兆, 晨勃频率',
     '晨勃减少可能与年龄增长（睾酮自然下降）、睡眠质量差、血管健康下降、药物影响、压力等因素有关。是男性健康的"风向标"。',
     '''<!-- wp:paragraph -->
<p>30岁时每天都有晨勃，到了40多岁一周只有两三次——这是很多人注意到但不好意思问的变化。<strong>晨勃减少是最容易被忽视的ED前兆。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>晨勃减少的五个主要原因</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>年龄相关的睾酮下降</strong>：40岁后睾酮每年自然下降约1%-2%。睾酮是夜间勃起的"燃料"，水平下降直接影响晨勃频率。</li>
<li><strong>睡眠质量下降</strong>：夜间勃起发生在REM快速眼动睡眠期。如果睡眠浅、频繁醒来、打鼾（OSA），REM睡眠减少→晨勃减少。</li>
<li><strong>血管健康退化</strong>：血管内皮功能随年龄和生活方式下降，影响勃起血流。晨勃减少可能是血管老化的早期征兆——阴茎动脉比冠状动脉更敏感。</li>
<li><strong>药物影响</strong>：降压药、抗抑郁药等。</li>
<li><strong>压力与疲劳</strong>：皮质醇升高抑制睾酮分泌。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>什么时候需要担心？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>一周2-3次晨勃在40-50岁属于正常范围。如果<strong>一周不到1次甚至完全消失</strong>，且同时出现真实性交硬度下降，建议做专业评估。Renova冲击波治疗可促进血管新生和改善夜间勃起——研究表明治疗后NPTR监测的夜间勃起频率和硬度显著改善。</p>
<!-- /wp:paragraph -->'''),

    ('22-meiyou-chenbo-shi-yangwei-ma', '没有晨勃是不是阳痿',
     '没有晨勃, 晨勃消失ED, NPTR, 夜间勃起监测',
     '没有晨勃不等于一定是阳痿，但确实是一个需要关注的信号。晨勃消失可能是ED的早期预警，也可能只是睡眠问题或暂时性的激素波动。',
     '''<!-- wp:paragraph -->
<p><strong>不一定，但值得重视。</strong>没有晨勃≠阳痿，二者不能画等号。但长期没有晨勃确实提示应该做一次专业评估。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>什么情况下没有晨勃是正常的？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>极度疲劳或睡眠不足（<5小时）</li>
<li>饮酒后的次日</li>
<li>重感冒或急性疾病期间</li>
<li>高强度运动后的恢复期</li>
<li>心理压力巨大的阶段</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>什么情况下没有晨勃需要考虑ED？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>持续时间</strong>：持续超过1个月</li>
<li><strong>伴发症状</strong>：同时出现真实性交硬度下降、性欲减退</li>
<li><strong>风险因素</strong>：有高血压/糖尿病/高血脂/长期吸烟史</li>
<li><strong>年龄</strong>：40岁以下却完全没有晨勃</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>如果晨勃持续长期消失，最准确的检查是<strong>NPTR（夜间阴茎勃起监测）</strong>——用仪器客观记录夜间勃起的次数、硬度和持续时间，可精确区分心理性和器质性ED。Renova冲击波治疗后NPTR客观指标改善已被研究证实。</p>
<!-- /wp:paragraph -->'''),

    # ── Group 2 gaps: #21, #22, #25 ──
    ('55-aoye-daozhi-yangwei', '熬夜会导致阳痿吗',
     '熬夜ED, 睡眠阳痿, 睾酮睡眠, 熬夜危害',
     '熬夜会通过降低睾酮分泌、增加氧化应激、损害血管内皮等方式影响勃起功能。长期熬夜是年轻人ED的重要诱因。',
     '''<!-- wp:paragraph -->
<p><strong>会，而且是年轻人ED最重要、最被忽视的诱因之一。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>熬夜损害勃起功能的三条通路</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>睾酮分泌锐减</strong>：睾酮主要在深度睡眠时分泌。一项发表于JAMA的研究指出，连续一周每晚睡不足5小时，年轻男性睾酮水平下降10%-15%——相当于提前老了10-15岁。睾酮是勃起功能的"燃料"，燃料不足，勃起自然困难。</li>
<li><strong>交感神经过度兴奋</strong>：睡眠不足使身体处于应激状态，交感神经持续激活，而勃起需要副交感神经主导。交感神经相当于勃起的"刹车"。</li>
<li><strong>氧化应激与血管损伤</strong>：睡眠剥夺增加体内氧化应激和炎症因子水平，损害血管内皮功能，减少NO生物利用度。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>熬夜导致的ED能恢复吗？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>大多数能。</strong>如果是短期熬夜导致的勃起功能下降，恢复规律睡眠（每晚7-8小时）1-2周后通常可改善。如果长期熬夜已经导致血管内皮功能障碍，可能需要结合运动、冲击波治疗等促进血管修复。</p>
<!-- /wp:paragraph -->'''),

    ('56-xiyan-daozhi-yangwei', '吸烟会导致阳痿吗',
     '吸烟ED, 尼古丁阳痿, 戒烟改善勃起, 血管性ED',
     '吸烟是ED的独立危险因素，吸烟者ED风险是非吸烟者的1.5-2倍。好消息是：戒烟后1年内勃起功能可显著改善。',
     '''<!-- wp:paragraph -->
<p><strong>会，吸烟是ED最明确的独立危险因素之一。</strong>多项大型流行病学研究一致证实：吸烟者ED风险是非吸烟者的1.5-2倍，且吸烟量与ED风险呈剂量-效应关系。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>吸烟如何损害勃起功能？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>血管收缩</strong>：尼古丁激活交感神经→血管平滑肌收缩→阴茎动脉供血减少。每吸一支烟，阴茎血流就会受影响。</li>
<li><strong>血管内皮损伤</strong>：一氧化碳（CO）与血红蛋白结合，降低血氧含量；焦油和自由基直接损害血管内皮细胞→NO合成减少。NO是启动勃起的核心分子。</li>
<li><strong>加速动脉粥样硬化</strong>：长期吸烟促进全身动脉硬化，阴茎动脉（比冠状动脉更细）是第一个"受害者"。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>戒烟后能恢复吗？——能！</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>研究表明<strong>戒烟后1年内勃起功能可显著改善</strong>。血管内皮有一定再生能力。但如果吸烟已经导致严重的动脉硬化和海绵体纤维化，完全恢复可能困难。所以<strong>越早戒烟越好</strong>。结合运动和Renova冲击波治疗可以促进血管修复。</p>
<!-- /wp:paragraph -->'''),

    ('57-40-sui-boqi-xiajiang', '40岁男人勃起功能下降是正常的吗',
     '40岁勃起下降, 年龄ED, 中年性功能, 睾酮下降40岁',
     '40岁后勃起功能有一定程度下降属于生理性变化，但显著下降不是"正常"的。应该区分是年龄相关的自然衰退还是疾病信号。',
     '''<!-- wp:paragraph -->
<p><strong>轻度下降是正常的，显著下降不是。</strong>40岁后勃起功能确实会有所变化——但这与"阳痿"有本质区别。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>40岁后勃起功能的正常变化</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>需要更多的物理刺激才能勃起（年轻时一个念头就够）</li>
<li>硬度可能从EHS 4级偶尔降到3级</li>
<li>不应期（两次勃起之间的间隔）延长</li>
<li>射精力度可能减弱</li>
<li>晨勃频率减少但不会完全消失</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>什么时候不是"正常"？——需要就医的信号</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>50%以上性生活都无法达到足够硬度</strong></li>
<li><strong>晨勃完全消失超过1个月</strong></li>
<li><strong>勃起困难+性欲同时显著下降</strong>（可能睾酮过低）</li>
<li><strong>合并高血压/糖尿病/高血脂/冠心病</strong></li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>40岁是男性健康的转折点。</strong>此时积极管理心血管健康、保持运动、控制体重、定期检查，勃起功能可以保持到60岁甚至70岁。如果已经出现明显下降，Renova冲击波治疗在这个年龄段效果很好——血管仍有较好的再生潜力。</p>
<!-- /wp:paragraph -->'''),

    # ── Group 4 gaps: #48, #49, #53, #56, #60 ──
    ('58-yangwei-neng-zhihao-ma-duoshao-qian', '阳痿能治好吗要花多少钱',
     '阳痿治疗费用, 长沙ED费用, 阳痿能治好吗, 冲击波费用',
     '阳痿能否治好取决于类型和严重程度。轻中度血管性ED有效率90%+。费用因方案不同：冲击波9600元/疗程、口服药每月数百元、手术数万元。',
     '''<!-- wp:paragraph -->
<p>这是门诊中最实际的两个问题。分开回答：<strong>"能治好吗"取决于病因类型和严重程度；"花多少钱"取决于选择哪种治疗方案。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>能治好吗？——分类型回答</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>轻中度血管性ED</strong>：有效率最高（Renova冲击波90%+），较大概率恢复正常勃起功能。</li>
<li><strong>心理性ED</strong>：预后最好，多数通过心理治疗+短期药物可完全恢复。</li>
<li><strong>糖尿病/重度ED</strong>：治疗难度较大，改善而非完全治愈是更现实的目标。部分可从重度改善到中度。</li>
<li><strong>神经性ED</strong>：治疗最为困难，改善有限。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>花多少钱？——长沙地区费用参考</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>Renova冲击波治疗</strong>：9600元/疗程（4次），大多数一个疗程见效。相比长期服药性价比更高。</li>
<li><strong>PDE5i口服药</strong>：每片约30-80元，按需使用。长期看每年药费约2000-5000元。</li>
<li><strong>检查费用</strong>：200-500元（血糖血脂性激素+必要时CDDU）</li>
<li><strong>假体手术</strong>：5-20万元（严重ED的最后选择）</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>关键是先明确诊断再选方案，避免花了钱效果不好。</strong>星沙华夏医院叶龙觉医生提供免费初诊评估。</p>
<!-- /wp:paragraph -->'''),

    ('59-boqizhangai-zuihao-zhiliao', '治疗勃起功能障碍最好的方法',
     'ED最佳治疗, 阳痿治疗方法, 冲击波vs药物, ED治疗方案',
     '没有"最好"的方法，只有最适合您的方法。ED治疗需根据病因、严重程度、个人偏好综合选择。冲击波适合血管性ED，药物适合按需使用。',
     '''<!-- wp:paragraph -->
<p>"最好的方法"是一个陷阱问题——<strong>没有适用于所有人的"最好"，只有最适合您个人情况的最佳方案。</strong>ED的治疗选择取决于三个关键因素：病因类型、严重程度、个人偏好。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>不同情况下的推荐方案</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>轻中度血管性ED</strong>：Renova冲击波治疗是首选——促进血管新生、从根源修复，有效率90%+。效果持续12-20个月，是非侵入性方案中最接近"治愈"的。</li>
<li><strong>心理性ED</strong>：认知行为治疗+短期小剂量PDE5i。重建成功经验打破焦虑循环。</li>
<li><strong>重度ED或多种病因</strong>：综合方案——冲击波治疗+PDE5i药物+生活方式三管齐下。</li>
<li><strong>偶尔需要辅助</strong>：按需使用PDE5i即可，不需大动干戈。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>治疗选择的决策逻辑</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>问自己三个问题：①我想从根本上修复还是每次临时解决？②我愿意一次性投入（冲击波9600元）还是分散花费（每月药物）？③我有心血管疾病风险因素吗（如果是，冲击波可能一石二鸟——同时改善勃起和心血管健康）？</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>叶龙觉医生建议：<strong>先做专业评估明确病因，再决定方案。</strong>免费初诊评估电话：15909415555。</p>
<!-- /wp:paragraph -->'''),

    ('60-chongjibo-vs-chiyao', '冲击波治疗ED和吃药哪个效果好',
     '冲击波vs吃药, Renova对比PDE5i, ED治疗方案比较, 治标vs治本',
     '冲击波和PDE5i各有优劣：冲击波从根源修复血管（治本），效果持续12-20个月但单次投入高；口服药起效快单次便宜但需每次服用（治标）。本文从五个维度全面对比。',
     '''<!-- wp:paragraph -->
<p>这是ED治疗中最经典的选择题。答案是：<strong>不是谁更好的问题，而是"治标"和"治本"的路径选择。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>五维对比表</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>治疗机制</strong>：冲击波→促进VEGF表达+血管新生，修复病理基础（治本）。PDE5i→抑制PDE5酶，延长cGMP半衰期，临时扩张血管（治标）。</li>
<li><strong>起效时间</strong>：冲击波→2-3次治疗后开始改善，疗程结束后1-3个月效果达高峰。PDE5i→服药后30-60分钟起效。</li>
<li><strong>持续时间</strong>：冲击波→12-20个月以上。PDE5i→4-6小时（西地那非/伐地那非）或36小时（他达拉非）。</li>
<li><strong>有效率</strong>：冲击波→轻中度血管性ED 90%+（Reisman 2015）。PDE5i→总体约70%，但对重度ED和PDE5i无效者差。</li>
<li><strong>费用</strong>：冲击波→一次性9600元/疗程。PDE5i→每片30-80元，长期看年费2000-5000元且持续支出。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>最佳策略：不是"二选一"而是组合</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>很多患者的最佳方案是<strong>冲击波修复血管+PDE5i作为过渡辅助</strong>——冲击波治疗期间如果需要性生活，按需使用小剂量PDE5i；等血管修复效果显现后逐渐减药至停药。叶龙觉医生可为您评估最适合的组合方案。</p>
<!-- /wp:paragraph -->'''),

    ('61-ED-xinjishu-zhiliao', '有什么新技术可以治疗阳痿',
     'ED新技术, 阳痿新疗法, 低能量冲击波, 干细胞ED, PRP ED',
     'ED治疗领域近年来出现了多项新技术：Renova线性冲击波（最成熟）、PRP富血小板血浆注射、干细胞治疗（实验阶段）、低强度脉冲超声波等。',
     '''<!-- wp:paragraph -->
<p>ED治疗领域在过去十年经历了从"吃药控制"到"修复病因"的范式转变。以下是<strong>循证医学证据支持的ED前沿治疗技术</strong>：</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>1. 低能量体外冲击波治疗（Li-ESWT）— 最成熟的新技术</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Renova线性冲击波是目前循证证据最充分的新技术。通过低能量冲击波（0.09mJ/mm²）刺激VEGF和血管新生，从根源修复血管性ED。优势：非侵入、无痛、效果持续12-20个月。EAU和中华医学会指南推荐。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>2. PRP（富血小板血浆）注射</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>抽取自身血液离心提取PRP，注射到海绵体内。PRP中的生长因子理论上可促进组织修复。初步研究显示有一定效果，但证据等级低于冲击波，长期安全性数据不足。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>3. 干细胞治疗（实验阶段）</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>从脂肪或骨髓提取间充质干细胞注射到海绵体，理论上可分化修复受损组织。有小型临床研究显示积极信号，但仍在研究阶段，国内未批准常规临床应用。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>4. 低强度脉冲超声（LIPUS）</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>原理类似冲击波，利用超声机械效应促进组织修复。初步研究显示有改善效果，但缺乏大样本RCT数据。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>目前最成熟、最有证据支持的新技术仍然是Renova冲击波。</strong></p>
<!-- /wp:paragraph -->'''),

    ('62-ED-wuli-zhiliao', 'ED物理治疗',
     'ED物理治疗, 冲击波治疗, 真空负压, 盆底肌训练, 非药物ED治疗',
     'ED物理治疗包括Renova冲击波、真空负压吸引装置（VED）、盆底肌训练（凯格尔运动）等。非药物、非侵入性，适合不愿或不适合服药的患者。',
     '''<!-- wp:paragraph -->
<p>ED物理治疗是指<strong>不依赖药物、通过物理方式改善勃起功能</strong>的治疗手段。对于不愿长期服药或因禁忌症不能使用PDE5i的患者，物理治疗是重要选择。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>三种主流ED物理治疗方法</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>Renova线性冲击波治疗（Li-ESWT）</strong>：通过低能量冲击波（0.09mJ/mm²）刺激VEGF促进血管新生，从根源修复血管性ED。非侵入性，有效率90%+（轻中度），效果持续12-20个月。是目前循证证据最充分的物理治疗。</li>
<li><strong>真空负压吸引装置（VED）</strong>：用负压吸引器使阴茎充血勃起，然后用张力环维持。优点：即时见效、无药物副作用。缺点：操作繁琐、可能出现瘀斑、勃起状态不够"自然"。</li>
<li><strong>盆底肌训练（凯格尔运动）</strong>：强化球海绵体肌和坐骨海绵体肌，增强静脉闭塞机制。研究显示凯格尔运动对轻度ED有效率约40%。成本为零，但需要坚持。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>物理治疗适合谁？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>①不愿或不适合长期服药者 ②PDE5i效果下降/无效者 ③希望从根本上改善血管健康而非临时解决的血管性ED患者 ④硝酸酯类服药者（禁止用PDE5i）。星沙华夏医院提供Renova冲击波治疗，叶龙觉医生为您评估是否适合。</p>
<!-- /wp:paragraph -->'''),

    # ── Group 6 gap: #80 ──
    ('80-liuweidihuang-wan-yangwei', '六味地黄丸治阳痿吗',
     '六味地黄丸ED, 六味地黄丸阳痿, 中药治ED, 肾阴虚ED',
     '六味地黄丸对肾阴虚型ED可能有一定帮助，但它不是"万能ED药"。妄用六味地黄丸可能加重肾阳虚或湿热型ED。需先辨证再用。',
     '''<!-- wp:paragraph -->
<p>六味地黄丸可能是中国最被滥用的"治阳痿"中成药。<strong>答案是：对特定证型可能有效，对大多数ED无效，盲目服用可能加重病情。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>六味地黄丸是治什么的？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>六味地黄丸出自宋代名医钱乙，原方是为<strong>小儿"五迟"（肾阴虚）</strong>而设，后来被扩展用于成人肾阴虚证。它的核心功效是<strong>滋补肾阴</strong>——针对肾阴虚（腰膝酸软、五心烦热、盗汗、口干咽燥、舌红少苔、脉细数）。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>为什么大多数人吃了没用？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>ED ≠ 肾虚</strong>：血管性ED占70%——补肾治不好血管问题。年轻人ED以肝郁和湿热为主——六味地黄丸滋阴碍湿，反而可能加重。</li>
<li><strong>肾虚 ≠ 肾阴虚</strong>：肾阳虚（畏寒怕冷、夜尿多）吃六味地黄丸等于"雪上加霜"。</li>
<li><strong>需要辨证施治</strong>：中医治ED需要先辨证——肝郁、湿热、血瘀、阴虚、阳虚，证型不同方药完全不同。</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>结论：不要自行购买六味地黄丸"治阳痿"。</strong>先到正规医疗机构明确ED类型（是血管性、神经性还是激素性），如果是中医证型问题，也要由中医师辨证后开方，而不是盲目吃药。</p>
<!-- /wp:paragraph -->'''),

    # ── Group 8 gaps: #89, #90, #92, #93, #94 ──
    ('89-yangwei-neng-chedi-zhihao-ma', '阳痿能彻底治好吗',
     '阳痿治愈, ED能治好吗, 阳痿根治, 勃起功能恢复',
     '阳痿能否彻底治好取决于病因类型和严重程度。轻中度血管性ED有效率90%+，很有可能恢复正常。重度ED和某些类型改善而非治愈是更现实的目标。关键是早诊断早治疗。',
     '''<!-- wp:paragraph -->
<p>这是所有ED患者最关心的问题。答案是：<strong>取决于ED的类型和严重程度——有些可以"治好"，有些只能"改善"。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>哪些ED可以"治好"（恢复自主正常勃起）？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>心理性ED</strong>：治愈把握最大。通过心理治疗+短期药物打破焦虑循环，多数可完全恢复且不需要继续服药。</li>
<li><strong>轻中度血管性ED</strong>：Renova冲击波治疗后，较大概率恢复正常勃起功能（有效率90%+），疗效持续12-20个月。</li>
<li><strong>生活方式导致的ED</strong>：戒烟+运动+减重后可以显著改善甚至恢复。</li>
<li><strong>药物性ED</strong>：停药或换药后大多恢复。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>哪些ED只能"改善"（需要管理而非期待根治）？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>重度血管性ED</strong>：冲击波+药物+生活方式可以改善但完全恢复困难</li>
<li><strong>糖尿病ED伴严重神经病变</strong>：治疗目标是改善到可完成性生活（可能需要辅助手段）</li>
<li><strong>前列腺癌根治术后严重神经损伤</strong>：恢复程度有限</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>核心结论：越早治疗，治愈可能性越高。</strong>轻中度阶段是"治愈窗口"，重度阶段目标是"改善"。不要拖。星沙华夏医院提供免费初诊评估。</p>
<!-- /wp:paragraph -->'''),

    ('90-zhongdu-yangwei-neng-zhihao-ma', '重度阳痿还能治好吗',
     '重度ED治疗, 重度阳痿, IIEF重度, ED康复',
     '重度ED治疗难度较大，"治好"可能不现实，但"显著改善"完全可以。通过综合治疗（冲击波+药物+生活方式），部分重度ED患者可以从需要假体恢复到口服药有效。',
     '''<!-- wp:paragraph -->
<p><strong>"治好"可能不现实，但"显著改善"完全有可能。</strong>重度ED（IIEF-EF≤7分或EHS 1-2级）的治疗目标是阶梯式的——从完全不能勃起到能完成性生活（即使需要辅助）。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>重度ED的治疗阶梯</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>第一阶梯：冲击波治疗</strong>——即使重度，部分患者仍可受益。Bechara等（2016）研究中包含重度患者，冲击波治疗后PDE5i有效率从0提升到60%。</li>
<li><strong>第二阶梯：冲击波+长期小剂量PDE5i</strong>——冲击波改善血管基础后，原本无效的PDE5i可能重新有效。</li>
<li><strong>第三阶梯：海绵体注射疗法</strong>——前列腺素E1或三联注射，有效率80-90%，但需每次注射。</li>
<li><strong>第四阶梯：阴茎假体植入</strong>——对其他治疗无效的最后选择，满意度约80-90%。</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>重要观念：</strong>重度ED治疗的目标不是"恢复到18岁"，而是"能够完成满意的性生活"。从完全不能到吃药或冲击波后可以——这就是临床成功。叶龙觉医生可为您评估您的具体情况和治疗潜力。</p>
<!-- /wp:paragraph -->'''),

    ('92-yangwei-zhiliao-duochang-shijian', '阳痿治疗需要多长时间',
     'ED治疗时间, 冲击波疗程, 阳痿康复时间, ED恢复期',
     'ED治疗时长因方案而异：Renova冲击波4周完成治疗+1-3个月效果达高峰；口服药每次按需服用；手术治疗一次性完成。关键是理解每种方案的"时间表"。',
     '''<!-- wp:paragraph -->
<p>不同治疗方案的"时间表"完全不同。了解每种方案的节奏，有助于设定期望值。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>各方案治疗时间一览</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>Renova冲击波治疗</strong>：4周完成治疗（每周1次×4次）。第2-3次后可能开始感受到晨勃恢复或硬度改善；疗程结束后1个月效果显现；<strong>3个月达到高峰效果</strong>（血管新生需要时间）。效果持续12-20个月。</li>
<li><strong>PDE5i口服药</strong>：没有"疗程"概念——每次性生活前30-60分钟按需服用，服药后有4-36小时窗口（取决于药物种类）。属于"每次用就有效，不用就没效"。</li>
<li><strong>生活方式干预</strong>：规律运动2-3个月后开始看到效果；减重可能需要3-6个月。</li>
<li><strong>海绵体注射</strong>：每次性生活前注射，5-10分钟起效。</li>
<li><strong>假体手术</strong>：一次性手术（1-2小时），术后恢复期4-6周后方可使用。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>为什么冲击波不是"立马有效"？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>很多患者问："为什么做了两次冲击波还没改善？"因为冲击波的作用机制是<strong>促进血管新生</strong>——新生毛细血管长出来需要2-4周。这是生物学的"慢过程"，但效果更持久。相比之下，药物的效果"来得快去得也快"。</p>
<!-- /wp:paragraph -->'''),

    ('93-chongjibo-duojiu-kanxiaoguo', '做了冲击波治疗后多久能看到效果',
     '冲击波见效时间, Renova效果, 冲击波治疗后感受, ED治疗预期',
     '冲击波治疗后通常在2-3次治疗开始感受到改善，疗程结束后1个月效果逐渐显现，3个月达到高峰。这是血管新生需要的时间。',
     '''<!-- wp:paragraph -->
<p>这是冲击波治疗前患者几乎必问的问题。答案是：<strong>不像吃药那么快（小时级别），但改善是持久的（月-年级别）。</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>冲击波效果时间线</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>第1次治疗后（第1周）</strong>：多数人没有明显变化。少数人可能感觉晨勃质量改善。完全正常——血管新生还没开始。</li>
<li><strong>第2-3次治疗后（第2-3周）</strong>：部分患者开始感受到改善。最早出现的改善通常是晨勃恢复或硬度感增强。这是血管内皮开始修复的信号。</li>
<li><strong>疗程结束后1个月</strong>：效果逐渐明显。IIEF-EF评分开始显著提升。新生毛细血管开始成熟。</li>
<li><strong>疗程结束后3个月</strong>：<strong>效果达到高峰。</strong>血管新生过程基本完成，勃起功能改善最大化。此时评估是否需要第2疗程最准确。</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><strong>重要提醒：</strong>冲击波治疗需要耐心。如果您需要治疗期间有性生活，可以使用小剂量PDE5i作为"过渡"。治疗前与叶龙觉医生充分沟通期望值很重要。</p>
<!-- /wp:paragraph -->'''),

    ('94-yangwei-zhiliaohou-huifufa-ma', '阳痿治疗后还会复发吗',
     'ED复发, 阳痿复发, 冲击波效果维持, ED长期效果',
     'ED治疗的远期效果取决于病因和治疗方式。冲击波效果可维持12-20个月，部分患者可更长。未管理好基础疾病（血糖血压血脂）和不良生活方式是复发的主要原因。',
     '''<!-- wp:paragraph -->
<p><strong>有可能，但可以有效预防。</strong>ED不是"一次治好终身免疫"的疾病——它更像高血压，需要持续的健康管理。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>不同治疗方式的复发率</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>冲击波治疗</strong>：多项研究随访12-20个月，多数患者维持在改善状态。部分患者每年做一次维护治疗可进一步延长效果。如果基础疾病控制良好（血糖血压血脂），复发率低。</li>
<li><strong>PDE5i口服药</strong>：不存在"复发"概念——因为不是修复性治疗。停药后效果消失属于正常，不是"复发"。</li>
<li><strong>假体手术</strong>：机械故障率5年约5-10%，15年约15-20%。</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>如何预防复发？</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>控制基础疾病是关键</strong>：血糖、血压、血脂——ED是这些问题的"下游"结果。上游不管理好，下游迟早复发。</li>
<li><strong>保持健康生活方式</strong>：规律运动（每周≥150分钟）、不吸烟、限酒、保持健康体重。</li>
<li><strong>定期随访</strong>：治疗后每6-12个月随访一次，及早发现功能下降的苗头。</li>
<li><strong>需要时做维护治疗</strong>：部分患者每年做1-2次冲击波维护可长期保持效果。</li>
</ul>
<!-- /wp:list -->'''),
]

if __name__ == '__main__':
    created = 0
    for slug, title, tags, excerpt, body in articles:
        filepath = os.path.join(OUT, slug + '.html')
        content = make_article(slug, title, tags, excerpt, body)
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        created += 1
        print(f'Created: {slug}.html')
    print(f'\nDone. {created} gap articles created.')
