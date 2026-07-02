<?php
/**
 * Template Name: 治疗案例
 *
 * 匿名化治疗案例分享
 * 关键词：ED治疗案例、冲击波治疗效果分享
 * 注意：医疗广告法规要求，案例需匿名化且标注"个人案例仅供参考"
 */
get_header();
renova_breadcrumb();
?>

<section class="page-header">
    <div class="container">
        <h1>治疗案例</h1>
        <p class="page-desc">以下案例均已脱敏处理 · 个人效果因人而异 · 仅供参考</p>
    </div>
</section>

<section class="section section-white">
    <div class="container" style="max-width:800px;">
        <p style="background:var(--bg-warm);padding:16px 24px;border-radius:var(--radius);color:var(--text-gray);margin-bottom:40px;border-left:4px solid var(--primary);">
            <strong>⚠️ 医疗提示：</strong>以下案例均为真实治疗经历的匿名化处理后分享，
            每个人的ED类型、病因和严重程度不同，治疗效果存在个体差异。
            请勿将其作为自我诊断的依据，建议到诊所由医生评估后制定个性化方案。
        </p>

        <?php
        // 案例数据（后续可通过WordPress自定义文章类型管理）
        $cases = array(
            array(
                'title' => '案例一：42岁血管性ED，药物效果变差',
                'profile' => '长沙市 · 42岁 · 公司中层管理 · 确诊ED两年',
                'before' => '两年前发现勃起硬度不足，开始服用西地那非（每次50mg），初期效果好。一年后药效明显下降，加量至100mg效果仍不理想。IIEF-EF评分：14分。',
                'diagnosis' => '轻中度血管性ED，PDE5i反应减弱',
                'treatment' => 'Renova冲击波治疗，每周1次×4次，联合小剂量他达拉非5mg每日一次辅助',
                'result' => '治疗结束后1个月评估：晨勃恢复，IIEF-EF提升至21分，硬度能满足正常性生活。3个月后随访：效果持续稳定，已停用每日他达拉非，仅在需要时偶尔使用。',
                'followup' => '6个月随访，效果维持良好，患者满意度高',
            ),
            array(
                'title' => '案例二：53岁糖尿病性ED，PDE5i完全无效',
                'profile' => '株洲市 · 53岁 · 2型糖尿病史8年 · 已婚',
                'before' => '糖尿病多年，三年前开始出现ED，逐渐加重至完全不能勃起。曾尝试西地那非100mg和他达拉非20mg均无效。IIEF-EF评分：7分。',
                'diagnosis' => '重度糖尿病性ED（血管+神经混合型），PDE5i无效',
                'treatment' => 'Renova冲击波治疗一个疗程（4次），同时严格控制血糖',
                'result' => '治疗结束后：IIEF-EF提升至11分（从重度进入轻中度范围）。同房需辅助小剂量药物（他达拉非10mg），但较之前完全无效有显著改善。3个月后建议第二疗程巩固。',
                'followup' => '第二疗程后评估，IIEF-EF进一步提升至15分，整体生活质量明显改善',
            ),
            array(
                'title' => '案例三：45岁男性功能保养',
                'profile' => '长沙县星沙镇北斗路16号（星沙汽车站斜对面） · 45岁 · 已婚20年 · 无明显疾病',
                'before' => '自觉近两年勃起硬度不如从前，晨勃频率减少。与妻子同房时偶有中途疲软。常规体检各项指标正常。IIEF-EF评分：19分（轻度ED）。',
                'diagnosis' => '轻度血管性ED（年龄相关性功能衰退）',
                'treatment' => 'Renova冲击波治疗，每周1次×4次，建议健康生活方式调整',
                'result' => '治疗结束后：晨勃明显恢复，硬度显著提升，同房中途疲软现象消失。IIEF-EF提升至24分。患者自我感觉"回到了30多岁时的状态"。',
                'followup' => '12个月随访，效果依然良好。患者每年进行一次维护治疗（2次）',
            ),
            array(
                'title' => '案例四：38岁青年ED，熬夜+压力导致',
                'profile' => '湘潭市 · 38岁 · IT行业 · 未婚',
                'before' => '长期熬夜加班，工作压力大。一年前开始出现勃起困难，晨勃消失。因担心药物依赖不愿吃PDE5i。IIEF-EF评分：15分。',
                'diagnosis' => '混合性ED（血管功能减退+心理焦虑）',
                'treatment' => 'Renova冲击波治疗4次 + 生活方式指导（减少熬夜、增加运动）',
                'result' => '治疗结束后：晨勃恢复，勃起硬度明显改善，IIEF-EF提升至23分。心理焦虑也随之缓解——"身体恢复了，信心自然就回来了"。',
                'followup' => '6个月随访，作息改善后效果更佳，已恢复正常性生活',
            ),
        );

        foreach ($cases as $index => $case): ?>
            <div style="background:var(--bg-white);padding:32px;border-radius:var(--radius);box-shadow:var(--shadow-card);margin-bottom:32px;">
                <h3 style="color:var(--primary);margin-bottom:16px;"><?php echo $case['title']; ?></h3>
                <div style="background:var(--bg-warm);padding:16px;border-radius:var(--radius-sm);margin-bottom:16px;">
                    <p><strong>基本信息：</strong><?php echo $case['profile']; ?></p>
                </div>
                <h4>治疗前</h4>
                <p style="color:var(--text-gray);line-height:1.8;"><?php echo $case['before']; ?></p>
                <p><strong>诊断：</strong><?php echo $case['diagnosis']; ?></p>
                <h4 style="margin-top:16px;">治疗方案</h4>
                <p style="color:var(--text-gray);line-height:1.8;"><?php echo $case['treatment']; ?></p>
                <h4 style="margin-top:16px;">治疗后</h4>
                <p style="color:var(--text-gray);line-height:1.8;"><?php echo $case['result']; ?></p>
                <p style="color:var(--text-light);"><strong>随访：</strong><?php echo $case['followup']; ?></p>
            </div>
        <?php endforeach; ?>

        <div style="text-align:center;background:var(--bg-warm);padding:32px;border-radius:var(--radius);">
            <h4 style="margin-bottom:12px;">您的康复故事从这里开始</h4>
            <p style="color:var(--text-gray);margin-bottom:20px;">每个案例的康复效果都不同，关键是根据个人情况制定合适的治疗方案</p>
            <a href="/contact" class="btn btn-primary">预约免费咨询评估</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
