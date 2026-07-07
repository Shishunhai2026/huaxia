<?php
/**
 * Template Name: 关于我们
 *
 * 诊所介绍 + 叶医生简介
 */
get_header();
renova_breadcrumb();
?>

<section class="page-header">
    <div class="container">
        <h1>关于我们</h1>
        <p class="page-desc">10年+临床经验 · 以色列原装设备 · 长沙县星沙镇</p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <!-- 诊所介绍 -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;margin-bottom:80px;">
            <div>
                <span class="section-label">诊所简介</span>
                <h2 style="margin-bottom:20px;">星沙华夏医院</h2>
                <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;margin-bottom:16px;">
                    星沙华夏医院位于长沙县星沙镇北斗路16号（星沙汽车站斜对面），是一所经卫生部门批准设立的<strong>中西医结合医疗机构</strong>，
                    持医疗执业许可证，已服务长沙及周边地区患者<strong>10余年</strong>。
                </p>
                <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;margin-bottom:16px;">
                    本诊所引进以色列<strong>Renova体外线性冲击波治疗仪</strong>（国械注进20173095171），
                    专业开展血管性勃起功能障碍（ED）的冲击波治疗和男性性功能保养。
                    是目前长沙地区为数不多的配备Renova原装设备的医疗机构之一。
                </p>
                <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;">
                    我们秉持<strong>专业、私密、亲和</strong>的服务理念，为每一位患者提供个性化、
                    私密化的诊疗服务。所有就诊均为一对一独立诊室，严格保护患者隐私。
                </p>
            </div>
            <div style="text-align:center;">
                <!-- 诊所照片占位 -->
                <div style="width:100%;aspect-ratio:4/3;background:var(--bg-warm);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--text-light);border:2px dashed var(--border-warm);">
                    <div style="text-align:center;">
                        <p style="font-size:3rem;">🏥</p>
                        <p>诊所实景照片</p>
                        <p style="font-size:0.8rem;">← 放置诊所外景/内部照片</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 李威医生介绍 -->
        <div id="doctor" style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;margin-bottom:80px;">
            <div style="text-align:center;order:-1;">
                <img src="<?php echo RENOVA_URI; ?>/assets/images/doctor-liwei.png"
                     alt="李威医生"
                     style="width:240px;height:auto;border-radius:var(--radius);margin:0 auto;box-shadow:var(--shadow-md);">
            </div>
            <div>
                <span class="section-label">专家介绍</span>
                <h2 style="margin-bottom:20px;">李威 主治医生</h2>
                <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;margin-bottom:16px;">
                    从事泌尿外科工作近二十年，在<strong>男性性功能障碍、前列腺疾病、生殖系感染、生殖整形</strong>
                    等疾病方面有较深的造诣。
                </p>
                <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;margin-bottom:16px;">
                    李医生在Renova冲击波治疗中，根据每位患者的具体情况制定
                    <strong>个性化治疗方案</strong>，确保最佳治疗效果。
                </p>
                <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;">
                    对待每一位患者，李医生始终坚持以<strong>耐心倾听、专业诊断、真诚沟通</strong>
                    为原则，帮助患者克服心理障碍，重建自信。
                </p>
            </div>
        </div>

        <!-- 医疗团队 -->
        <div id="team" style="margin-bottom:80px;">
            <div class="section-header" style="text-align:center;margin-bottom:48px;">
                <span class="section-label">医疗团队</span>
                <h2 style="margin-bottom:16px;">专业医师团队</h2>
                <p class="section-desc">三位资深医师，为您提供全方位男性健康诊疗服务</p>
            </div>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:40px;">
                <!-- 叶龙觉 -->
                <div style="text-align:center;background:var(--bg-cream);border-radius:var(--radius);padding:40px 24px;box-shadow:var(--shadow-sm);">
                    <img src="<?php echo RENOVA_URI; ?>/assets/images/doctor-yelongjue.png"
                         alt="叶龙觉医生"
                         style="width:180px;height:auto;border-radius:var(--radius);margin:0 auto 20px;box-shadow:var(--shadow-sm);">
                    <h3 style="margin-bottom:8px;color:var(--primary);">叶龙觉 院长</h3>
                    <p style="color:var(--accent);font-size:0.9rem;margin-bottom:12px;">★ 院长 · 外科副主任医师</p>
                    <p style="color:var(--text-gray);font-size:0.95rem;line-height:1.8;">
                        长沙华夏医院院长、长沙市中医学会理事。曾任长沙县中医院、长沙县妇幼保健院业务院长。从事外科临床、科研、医院管理等工作近五十年，擅长各类外科微创手术，是享誉长沙县的"外科一把刀"。
                    </p>
                </div>
                <!-- 李威 -->
                <div style="text-align:center;background:var(--bg-cream);border-radius:var(--radius);padding:40px 24px;box-shadow:var(--shadow-sm);">
                    <img src="<?php echo RENOVA_URI; ?>/assets/images/doctor-liwei.png"
                         alt="李威医生"
                         style="width:180px;height:auto;border-radius:var(--radius);margin:0 auto 20px;box-shadow:var(--shadow-sm);">
                    <h3 style="margin-bottom:8px;color:var(--primary);">李威 医生</h3>
                    <p style="color:var(--accent);font-size:0.9rem;margin-bottom:12px;">★ 外科主任 · 主治医师</p>
                    <p style="color:var(--text-gray);font-size:0.95rem;line-height:1.8;">
                        从事泌尿外科工作近二十年，在男性性功能障碍、前列腺疾病、生殖系感染、生殖整形等疾病方面有较深的造诣。
                    </p>
                </div>
                <!-- 聂建军 -->
                <div style="text-align:center;background:var(--bg-cream);border-radius:var(--radius);padding:40px 24px;box-shadow:var(--shadow-sm);">
                    <img src="<?php echo RENOVA_URI; ?>/assets/images/doctor-niejianjun.png"
                         alt="聂建军医生"
                         style="width:180px;height:auto;border-radius:var(--radius);margin:0 auto 20px;box-shadow:var(--shadow-sm);">
                    <h3 style="margin-bottom:8px;color:var(--primary);">聂建军 医生</h3>
                    <p style="color:var(--accent);font-size:0.9rem;margin-bottom:12px;">★ 外科主任 · 主治医师</p>
                    <p style="color:var(--text-gray);font-size:0.95rem;line-height:1.8;">
                        从事外科临床工作二十余年，擅长生殖整形、肛肠、疝气等外科疾病的诊治，熟练开展相关外科微创手术。
                    </p>
                </div>
            </div>
        </div>

        <!-- 设备展示 -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;">
            <div>
                <span class="section-label">设备展示</span>
                <h2 style="margin-bottom:20px;">Renova体外线性冲击波治疗仪</h2>
                <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;margin-bottom:16px;">
                    Renova由以色列Initia公司研发制造，是全球第一款<strong>专为ED治疗设计</strong>的
                    线性冲击波系统。其独特的<strong>线性聚焦技术</strong>可产生70mm长的治疗区域，
                    完整覆盖阴茎海绵体和阴茎脚，解决了传统点聚焦冲击波需要反复定位的缺点。
                </p>
                <ul style="list-style:none;padding:0;">
                    <li style="padding:8px 0;">✅ 以色列原装进口</li>
                    <li style="padding:8px 0;">✅ NMPA认证（国械注进20173095171）</li>
                    <li style="padding:8px 0;">✅ 欧盟CE认证</li>
                    <li style="padding:8px 0;">✅ 20+篇国际SCI文献支持</li>
                    <li style="padding:8px 0;">✅ EAU/APSSM指南推荐技术</li>
                </ul>
            </div>
            <div style="text-align:center;">
                <!-- 设备照片占位 -->
                <div style="width:100%;aspect-ratio:4/3;background:var(--bg-warm);border-radius:var(--radius);display:flex;align-items:center;justify-content:center;color:var(--text-light);border:2px dashed var(--border-warm);">
                    <div style="text-align:center;">
                        <p style="font-size:3rem;">🖥️</p>
                        <p>Renova设备照片</p>
                        <p style="font-size:0.8rem;">← 放置Renova设备实拍照片</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
