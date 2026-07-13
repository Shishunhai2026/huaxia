<?php
/**
 * 首页模板 - 星沙华夏医院
 *
 * 包含：Hero区、核心优势、治疗介绍、数据展示、客户见证、FAQ、CTA
 * SEO关键词密度：长沙ED治疗、Renova冲击波、血管性勃起功能障碍、男性功能保养
 */
get_header();
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-inner">
            <div class="hero-content">
                <h1>
                    长沙<span class="highlight">ED治疗</span>新选择<br>
                    以色列Renova线性冲击波
                </h1>
                <p class="hero-subtitle">
                    非侵入 · 不手术 · 不吃药 · 无痛治疗<br>
                    <strong>轻中度血管性勃起功能障碍有效率90%以上</strong><br>
                    国内外权威指南推荐的ED一线治疗方案
                </p>
                <p style="font-size:1rem;color:var(--text-gray);margin-bottom:20px;line-height:1.6;">
                    长沙县星沙镇北斗路16号（星沙汽车站斜对面）· 叶龙觉医生坐诊<br>
                    针对硬度不够、晨勃消失、中途疲软、PDE5i无效等ED问题提供专业诊疗
                </p>
                <div class="hero-features">
                    <span class="hero-feature-item"><span class="icon-check">✓</span> 欧盟CE认证</span>
                    <span class="hero-feature-item"><span class="icon-check">✓</span> NMPA批准</span>
                    <span class="hero-feature-item"><span class="icon-check">✓</span> EAU指南推荐</span>
                    <span class="hero-feature-item"><span class="icon-check">✓</span> 20+篇SCI文献</span>
                    <span class="hero-feature-item"><span class="icon-check">✓</span> 10年+临床经验</span>
                </div>
                <div class="hero-actions">
                    <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary btn-large">立即预约咨询</a>
                    <a href="<?php echo home_url('/treatment'); ?>" class="btn btn-outline btn-large">了解治疗详情</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="hero-image-placeholder">
                    🏥<br>Renova线性冲击波治疗仪<br>
                    <small style="font-size:0.8rem;">国械注进20173095171</small><br><br>
                    <small>← 此处放置诊所实景照片或设备照片</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 快速导航：症状自查 + 费用了解 -->
<section class="section section-white" style="padding:40px 0;">
    <div class="container">
        <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
            <a href="<?php echo home_url('/symptom-check'); ?>" class="card" style="text-align:center;text-decoration:none;color:inherit;">
                <div class="card-icon">🔍</div>
                <h3>ED症状自查</h3>
                <p style="color:var(--text-gray);font-size:0.9rem;">硬度不够？晨勃消失？在线自测勃起功能</p>
            </a>
            <a href="<?php echo home_url('/pricing'); ?>" class="card" style="text-align:center;text-decoration:none;color:inherit;">
                <div class="card-icon">💰</div>
                <h3>治疗费用透明</h3>
                <p style="color:var(--text-gray);font-size:0.9rem;">冲击波治疗多少钱？各方案费用对比</p>
            </a>
            <a href="<?php echo home_url('/treatment-comparison'); ?>" class="card" style="text-align:center;text-decoration:none;color:inherit;">
                <div class="card-icon">📊</div>
                <h3>治疗方案对比</h3>
                <p style="color:var(--text-gray);font-size:0.9rem;">冲击波vs吃药vs手术，哪种适合您？</p>
            </a>
            <a href="<?php echo home_url('/mens-health'); ?>" class="card" style="text-align:center;text-decoration:none;color:inherit;">
                <div class="card-icon">💪</div>
                <h3>男性功能保养</h3>
                <p style="color:var(--text-gray);font-size:0.9rem;">如何预防阳痿？运动饮食生活方式建议</p>
            </a>
        </div>
    </div>
</section>

<!-- 核心优势 -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-label">为什么选择我们</span>
            <h2 class="section-title">长沙领先的冲击波ED治疗医院</h2>
            <p class="section-desc">10年+临床经验 · 以色列原装进口设备 · 私密就诊环境</p>
        </div>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">🔬</div>
                <h3>以色列原装进口设备</h3>
                <p>采用以色列Initia公司研发的Renova体外线性冲击波治疗仪，NMPA认证（国械注进20173095171），专为ED治疗设计。</p>
            </div>
            <div class="card">
                <div class="card-icon">📊</div>
                <h3>临床有效率90%+</h3>
                <p>多篇国际SCI文献证实：轻中度血管性ED治疗有效率90%以上，对PDE5抑制剂无效患者有效率60%+，疗效持续12个月。</p>
            </div>
            <div class="card">
                <div class="card-icon">🎯</div>
                <h3>线性聚焦技术</h3>
                <p>Renova独有的70mm线性治疗区域，完整覆盖阴茎海绵体和阴茎脚，优于传统点聚焦冲击波，治疗更精准有效。</p>
            </div>
            <div class="card">
                <div class="card-icon">🔒</div>
                <h3>私密安心就诊</h3>
                <p>独立诊室，一对一私密问诊，严格保护患者隐私。温馨亲和的环境，让您轻松就诊，无心理负担。</p>
            </div>
            <div class="card">
                <div class="card-icon">⚡</div>
                <h3>治疗快速无痛</h3>
                <p>每次治疗约20分钟，每周1次，共4次一疗程。无需麻醉，不手术，不吃药，随治随走，不影响工作生活。</p>
            </div>
            <div class="card">
                <div class="card-icon">🩺</div>
                <h3>10年+临床经验</h3>
                <p>叶医生从事中西医结合临床工作10余年，丰富的男科诊疗经验，为您制定个性化治疗方案。</p>
            </div>
        </div>
    </div>
</section>

<!-- 数据展示 -->
<section class="section section-warm">
    <div class="container">
        <div class="section-header">
            <span class="section-label">数据说话</span>
            <h2 class="section-title">ED治疗，效果看得见</h2>
        </div>
        <div class="stats-row">
            <div class="stat-item">
                <span class="stat-number">90%<small style="font-size:0.5em;color:var(--text-light);">+</small></span>
                <span class="stat-label">轻中度血管性ED<br>治疗有效率</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">100%</span>
                <span class="stat-label">轻度ED患者<br>治疗有效率</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">60%<small style="font-size:0.5em;color:var(--text-light);">+</small></span>
                <span class="stat-label">PDE5i无效患者<br>治疗有效率</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">12<small style="font-size:0.5em;color:var(--text-light);">个月</small></span>
                <span class="stat-label">疗效持续时间<br>（多篇文献证实）</span>
            </div>
        </div>
        <p style="text-align:center;margin-top:24px;color:var(--text-light);font-size:0.9rem;">
            * 数据来源：Reisman Y, Hind A, et al. Int J Impot Res. 2015; Bechara A, et al. Sex Med. 2016
        </p>
    </div>
</section>

<!-- 治疗介绍 -->
<section class="section section-white">
    <div class="container">
        <div class="treatment-highlight">
            <div class="treatment-info">
                <span class="section-label">治疗方案</span>
                <h2><?php echo get_option('renova_short_name', 'Renova'); ?>冲击波治疗ED</h2>
                <p class="lead">
                    Renova线性冲击波通过低能量声波刺激阴茎海绵体，<strong>促进血管新生（angiogenesis）</strong>，
                    改善阴茎血流动力学，从根源上恢复自然勃起功能。是目前唯一可能<strong>治愈</strong>ED的非侵入性治疗方案。
                </p>
                <ul class="treatment-points">
                    <li>非侵入性治疗，无需手术或注射</li>
                    <li>不使用药物，无药物副作用</li>
                    <li>治疗过程无痛，无需麻醉</li>
                    <li>每次仅20分钟，共4次一个疗程</li>
                    <li>根源修复，改善阴茎血流</li>
                    <li>疗效持久，可维持12个月以上</li>
                </ul>
                <a href="<?php echo home_url('/treatment'); ?>" class="btn btn-primary" style="margin-top:20px;">了解详细治疗方案</a>
            </div>
            <div class="treatment-process">
                <h3 style="margin-bottom:24px;">治疗流程</h3>
                <div class="process-step">
                    <div class="process-number">1</div>
                    <div class="process-content">
                        <h4>初诊评估</h4>
                        <p>详细问诊+IIEF量表评估，确定ED类型和严重程度</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-number">2</div>
                    <div class="process-content">
                        <h4>确定方案</h4>
                        <p>根据评估结果制定个性化冲击波治疗方案</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-number">3</div>
                    <div class="process-content">
                        <h4>开始治疗</h4>
                        <p>Renova设备治疗，每次20分钟，左右阴茎脚+海绵体全覆盖</p>
                    </div>
                </div>
                <div class="process-step">
                    <div class="process-number">4</div>
                    <div class="process-content">
                        <h4>随访评估</h4>
                        <p>疗程结束后1个月、3个月、6个月随访，评估IIEF改善情况</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $video_dir = get_template_directory_uri() . '/assets/videos'; ?>
<!-- 三甲医院专家介绍 -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-label">专家解读</span>
            <h2 class="section-title">三甲医院男科专家教授对Renova的介绍</h2>
            <p class="section-desc">以下视频收集自网络，汇集了多位三甲医院男科专家对Renova线性冲击波治疗ED的临床解读</p>
        </div>
        <div class="video-gallery">
            <div class="video-card">
                <video controls preload="metadata" poster="" class="video-player">
                    <source src="<?php echo $video_dir; ?>/1.mp4" type="video/mp4">
                    您的浏览器不支持视频播放
                </video>
            </div>
            <div class="video-card">
                <video controls preload="metadata" poster="" class="video-player">
                    <source src="<?php echo $video_dir; ?>/2.mp4" type="video/mp4">
                    您的浏览器不支持视频播放
                </video>
            </div>
            <div class="video-card">
                <video controls preload="metadata" poster="" class="video-player">
                    <source src="<?php echo $video_dir; ?>/3.mp4" type="video/mp4">
                    您的浏览器不支持视频播放
                </video>
            </div>
            <div class="video-card">
                <video controls preload="metadata" poster="" class="video-player">
                    <source src="<?php echo $video_dir; ?>/4.mp4" type="video/mp4">
                    您的浏览器不支持视频播放
                </video>
            </div>
            <div class="video-card">
                <video controls preload="metadata" poster="" class="video-player">
                    <source src="<?php echo $video_dir; ?>/5.mp4" type="video/mp4">
                    您的浏览器不支持视频播放
                </video>
            </div>
            <div class="video-card">
                <video controls preload="metadata" poster="" class="video-player">
                    <source src="<?php echo $video_dir; ?>/6.mp4" type="video/mp4">
                    您的浏览器不支持视频播放
                </video>
            </div>
        </div>
        <p style="text-align:center;margin-top:20px;color:var(--text-light);font-size:0.85rem;">（视频来自网络，如有侵权，请告知，我们立即处理）</p>
    </div>
</section>

<!-- 患者见证 -->
<section class="section section-warm">
    <div class="container">
        <div class="section-header">
            <span class="section-label">患者见证</span>
            <h2 class="section-title">他们选择了Renova冲击波治疗</h2>
            <p class="section-desc">为保护患者隐私，以下案例均经脱敏处理</p>
        </div>
        <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));">
            <div class="testimonial-card">
                <p class="quote">"我是从网上了解到冲击波治疗的，得了ED两年，吃了不少药效果不稳定。在叶医生这里做了4次治疗后，改善非常明显，现在已经能和妻子正常同房了。真的感谢叶医生。"</p>
                <p class="author">— 长沙市 · 42岁 · 血管性ED · 治疗时间：2024年</p>
            </div>
            <div class="testimonial-card">
                <p class="quote">"因为糖尿病导致的ED，吃了两年PDE5抑制剂，效果越来越差。没想到冲击波治疗对我这种药效不好的也有效，治疗完一个疗程后有明显好转。"</p>
                <p class="author">— 株洲市 · 53岁 · 糖尿病性ED · PDE5i无效 · 治疗时间：2024年</p>
            </div>
            <div class="testimonial-card">
                <p class="quote">"40岁以后明显感觉勃起功能不如以前了，听朋友介绍来做保养性治疗。做了之后晨勃恢复了，硬度也提高了，很满意。"</p>
                <p class="author">— 长沙县 · 45岁 · 男性功能保养 · 治疗时间：2024年</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-label">常见问题</span>
            <h2 class="section-title">关于冲击波治疗ED，您可能想问</h2>
        </div>
        <div class="faq-list">
            <div class="faq-item">
                <div class="faq-question" onclick="this.parentElement.classList.toggle('open')">冲击波治疗ED真的有效吗？</div>
                <div class="faq-answer">
                    <p>是的，大量临床研究证实了其有效性。根据Reisman等（2015）发表的研究，58例血管性ED患者接受Renova冲击波治疗后，轻中度ED有效率达90.57%，疗效持续至少6个月。中国仁济医院的研究也证实Li-ESWT可显著改善ED患者的主观和客观勃起功能指标。</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="this.parentElement.classList.toggle('open')">治疗过程痛吗？需要打麻药吗？</div>
                <div class="faq-answer">
                    <p>治疗过程基本无痛，无需麻醉。低能量冲击波能量密度仅0.09mJ/mm²，绝大多数患者治疗过程中仅有轻微感觉。治疗结束后即可正常活动，不影响工作生活。</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="this.parentElement.classList.toggle('open')">一个疗程多少钱？需要做几个疗程？</div>
                <div class="faq-answer">
                    <p>一个疗程共4次治疗，每周1次，费用为9600元。大多数患者一个疗程即可看到显著效果。少数重度患者可能需要第二个疗程巩固，具体视个人情况由医生评估后确定。</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="this.parentElement.classList.toggle('open')">我吃伟哥（PDE5i）已经没效果了，还能做冲击波吗？</div>
                <div class="faq-answer">
                    <p>可以。Bechara等（2016）的研究专门针对PDE5抑制剂无效的ED患者，结果显示冲击波治疗有效率达60%，且疗效持续12个月。冲击波治疗的机制不同于药物——它通过促进血管新生从根本上改善血流，而不是临时扩张血管。</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="this.parentElement.classList.toggle('open')">治疗后多久能看到效果？效果能维持多久？</div>
                <div class="faq-answer">
                    <p>一般在治疗2-3次后开始感受到改善，疗程结束后1-3个月效果达到最佳。多项研究（包括20个月长期随访）显示疗效可维持12-20个月以上。部分患者可根据需要定期做维护治疗。</p>
                </div>
            </div>
        </div>
        <div style="text-align:center;margin-top:32px;">
            <a href="<?php echo home_url('/faq'); ?>" class="btn btn-outline">查看更多常见问题</a>
        </div>
    </div>
</section>

<!-- 长沙各区就诊指南 -->
<section class="section section-white" style="padding:40px 0;">
    <div class="container">
        <div class="section-header">
            <span class="section-label">服务范围</span>
            <h2 class="section-title">长沙各区及周边便捷就诊</h2>
            <p class="section-desc">位于长沙县星沙镇北斗路16号（星沙汽车站斜对面），交通便利，私密就诊环境</p>
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;margin-top:24px;">
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">芙蓉区男科</span>
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">岳麓区男科</span>
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">雨花区男科</span>
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">天心区男科</span>
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">开福区男科</span>
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">望城区男科</span>
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">长沙县男科</span>
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">星沙男科医院</span>
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">株洲男科就诊</span>
            <span style="background:var(--bg-warm);padding:8px 20px;border-radius:50px;font-size:0.9rem;color:var(--text-gray);">湘潭男科就诊</span>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2>迈出改善男性健康的第一步</h2>
        <p>私密咨询 · 专业评估 · 个性化治疗方案<br>所有咨询严格保密，请放心就诊</p>
        <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary btn-large">立即预约免费咨询</a>
    </div>
</section>

<?php get_footer(); ?>
