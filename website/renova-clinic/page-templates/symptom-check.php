<?php
/**
 * Template Name: 症状自查
 *
 * ED症状自查页面 — 覆盖搜索漏斗第一层（症状自查）
 * 目标关键词：硬度不够是什么原因、晨勃消失了正常吗、硬一会就软了是什么问题、
 *             突然硬不起来了怎么回事、不能完全勃起是怎么回事
 * 搜索意图：信息获取型 — Table 6 第一层
 */
get_header();
renova_breadcrumb();
?>

<section class="page-header">
    <div class="container">
        <h1>ED症状自查</h1>
        <p class="page-desc">了解您的勃起功能状况 · 科学评估 · 及时就医</p>
    </div>
</section>

<!-- IIEF-EF简易自评 -->
<section class="section section-white">
    <div class="container" style="max-width:800px;">
        <div style="margin-bottom:60px;">
            <h2 style="border-left:4px solid var(--primary);padding-left:16px;margin-bottom:24px;">IIEF-EF简易自评量表</h2>
            <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;margin-bottom:32px;">
                <strong>IIEF-EF</strong>（国际勃起功能指数-勃起功能域）是国际公认的ED严重程度评估工具。
                以下为简化版5题自测，回答过去<strong>4周</strong>的情况。完成自评后对照下方的评分标准了解您的ED严重程度。
            </p>

            <div style="background:var(--bg-white);padding:32px;border-radius:var(--radius);box-shadow:var(--shadow-card);margin-bottom:24px;">
                <h3 style="color:var(--primary);margin-bottom:16px;">自我评估问题</h3>
                <p style="color:var(--text-gray);margin-bottom:24px;">请回想过去4周的情况，对照以下5个方面进行评估：</p>

                <ol style="line-height:2.5;font-size:1.05rem;">
                    <li><strong>勃起信心：</strong>您对能获得并维持勃起有多少信心？</li>
                    <li><strong>勃起硬度：</strong>受到性刺激而勃起时，有多少次硬度足以插入？</li>
                    <li><strong>维持勃起：</strong>性交时，插入后有多少次能够维持勃起？</li>
                    <li><strong>完成性交：</strong>性交时，维持勃起至完成性交有多大困难？</li>
                    <li><strong>性交满意度：</strong>尝试性交时，有多少次感到满足？</li>
                </ol>
            </div>

            <div style="background:var(--bg-white);padding:32px;border-radius:var(--radius);box-shadow:var(--shadow-card);margin-bottom:24px;">
                <h3 style="color:var(--primary);margin-bottom:16px;">评分标准（IIEF-EF总分）</h3>
                <table style="width:100%;border-collapse:collapse;text-align:center;">
                    <thead>
                        <tr style="background:var(--bg-warm);">
                            <th style="padding:12px;border:1px solid var(--border-warm);">评分范围</th>
                            <th style="padding:12px;border:1px solid var(--border-warm);">ED严重程度</th>
                            <th style="padding:12px;border:1px solid var(--border-warm);">建议</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding:12px;border:1px solid var(--border-warm);font-weight:600;">22-25分</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:var(--success);">无ED</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:var(--text-gray);">保持良好的生活方式</td>
                        </tr>
                        <tr>
                            <td style="padding:12px;border:1px solid var(--border-warm);font-weight:600;">17-21分</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:#D4A017;">轻度ED</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:var(--text-gray);">适合冲击波治疗，效果最佳</td>
                        </tr>
                        <tr>
                            <td style="padding:12px;border:1px solid var(--border-warm);font-weight:600;">12-16分</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:#C17817;">轻中度ED</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:var(--text-gray);">冲击波治疗最佳适应人群</td>
                        </tr>
                        <tr>
                            <td style="padding:12px;border:1px solid var(--border-warm);font-weight:600;">8-11分</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:#CC3333;">中度ED</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:var(--text-gray);">建议面诊评估，可考虑综合治疗</td>
                        </tr>
                        <tr>
                            <td style="padding:12px;border:1px solid var(--border-warm);font-weight:600;">≤7分</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:#CC0000;">重度ED</td>
                            <td style="padding:12px;border:1px solid var(--border-warm);color:var(--text-gray);">需综合治疗，建议尽快就医评估</td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-size:0.85rem;color:var(--text-light);margin-top:12px;">
                    * 简化自评仅供参考，不能替代专业医生的诊断。如需准确评估请到正规医疗机构做完整的IIEF-EF评测。
                </p>
            </div>
        </div>

        <!-- 常见症状对照表 -->
        <div style="margin-bottom:60px;">
            <h2 style="border-left:4px solid var(--primary);padding-left:16px;margin-bottom:24px;">常见症状对照：您属于哪种情况？</h2>
            <p style="font-size:1.05rem;color:var(--text-gray);line-height:2;margin-bottom:24px;">
                以下是ED最常见的症状表现，请对照您的情况。如果<strong>持续3个月以上</strong>出现以下任一情况，建议到正规医疗机构评估。
            </p>

            <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));">
                <div class="card">
                    <h3 style="color:var(--primary);">硬度不够</h3>
                    <p style="color:var(--text-gray);line-height:2;">
                        <strong>表现：</strong>有性欲，也能部分勃起，但硬度不足以插入或维持性交。<br><br>
                        <strong>常见原因：</strong><br>
                        • 动脉供血不足（最常见）<br>
                        • 静脉漏（血液无法截留）<br>
                        • 早期血管病变信号<br><br>
                        <strong>怎么办：</strong><br>
                        • 硬度不够但晨勃正常 → 可能是心理因素<br>
                        • 硬度不够且晨勃也差 → 器质性可能性大，建议检查<br>
                        • Renova冲击波对轻中度硬度不足效果最佳（有效率90%+）
                    </p>
                </div>

                <div class="card">
                    <h3 style="color:var(--primary);">晨勃消失或减少</h3>
                    <p style="color:var(--text-gray);line-height:2;">
                        <strong>表现：</strong>早晨醒来时阴茎没有勃起，或晨勃频率明显减少。<br><br>
                        <strong>为什么重要：</strong><br>
                        • 晨勃是夜间自发性勃起的一部分<br>
                        • 健康男性每晚有3-5次夜间勃起<br>
                        • 晨勃消失可能提示器质性ED<br><br>
                        <strong>怎么办：</strong><br>
                        • 偶尔消失可能是疲劳/压力<br>
                        • 持续1个月以上 → 建议就医检查<br>
                        • 冲击波可改善夜间勃起频率和硬度
                    </p>
                </div>

                <div class="card">
                    <h3 style="color:var(--primary);">中途疲软</h3>
                    <p style="color:var(--text-gray);line-height:2;">
                        <strong>表现：</strong>刚插入时硬度尚可，但很快就变软，无法维持到射精。<br><br>
                        <strong>常见原因：</strong><br>
                        • 静脉闭塞功能障碍<br>
                        • 焦虑和紧张<br>
                        • PDE5信号通路效率下降<br><br>
                        <strong>怎么办：</strong><br>
                        • 偶发可能是疲劳/紧张<br>
                        • 经常出现 → 建议评估血管功能<br>
                        • 冲击波可改善海绵体血管充盈
                    </p>
                </div>

                <div class="card">
                    <h3 style="color:var(--primary);">无法勃起</h3>
                    <p style="color:var(--text-gray);line-height:2;">
                        <strong>表现：</strong>有性刺激但完全无法勃起。<br><br>
                        <strong>常见原因：</strong><br>
                        • 重度血管性ED<br>
                        • 严重神经损伤<br>
                        • 内分泌严重异常<br>
                        • 药物副作用<br><br>
                        <strong>怎么办：</strong><br>
                        • 需全面检查明确病因<br>
                        • 可能需要综合治疗方案<br>
                        • 部分患者冲击波+药物联合有效
                    </p>
                </div>

                <div class="card">
                    <h3 style="color:var(--primary);">时间短 + 硬度差</h3>
                    <p style="color:var(--text-gray);line-height:2;">
                        <strong>表现：</strong>勃起硬度不足，且射精控制能力差（早泄合并ED）。<br><br>
                        <strong>常见原因：</strong><br>
                        • 器质性因素叠加心理焦虑<br>
                        • 两者相互加剧——硬度不好→焦虑→时间更短<br><br>
                        <strong>怎么办：</strong><br>
                        • 先解决硬度问题（冲击波治疗）<br>
                        • 硬度改善后时间问题常随之改善<br>
                        • 必要时联合早泄治疗方案
                    </p>
                </div>

                <div class="card">
                    <h3 style="color:var(--primary);">特定情境ED</h3>
                    <p style="color:var(--text-gray);line-height:2;">
                        <strong>表现：</strong>晨勃和手淫时硬度正常，但与伴侣同房时无法勃起。<br><br>
                        <strong>常见原因：</strong><br>
                        • 心理性ED（焦虑、关系问题）<br>
                        • 特定情境压力<br>
                        • 伴侣关系问题<br><br>
                        <strong>怎么办：</strong><br>
                        • 晨勃正常大概率心理性<br>
                        • 心理咨询+伴侣沟通<br>
                        • 排除心理因素后仍有问题需检查
                    </p>
                </div>
            </div>
        </div>

        <!-- 何时就医 -->
        <div style="margin-bottom:60px;">
            <h2 style="border-left:4px solid var(--primary);padding-left:16px;margin-bottom:24px;">以下情况建议及时就医</h2>
            <div style="background:var(--bg-white);padding:32px;border-radius:var(--radius);box-shadow:var(--shadow-card);">
                <ul style="line-height:2.5;font-size:1.05rem;">
                    <li>🚩 勃起困难<strong>持续超过3个月</strong></li>
                    <li>🚩 晨勃<strong>持续消失超过1个月</strong></li>
                    <li>🚩 硬度不足<strong>影响到正常性生活</strong></li>
                    <li>🚩 口服药物效果<strong>明显下降或无效</strong></li>
                    <li>🚩 同时伴有<strong>糖尿病、高血压、高血脂</strong>等慢性疾病</li>
                    <li>🚩 勃起问题<strong>造成明显的心理压力和伴侣关系紧张</strong></li>
                    <li>🚩 <strong>40岁以下</strong>突然出现的ED（需要排除器质性病变）</li>
                    <li>🚩 伴有<strong>会阴部疼痛、排尿异常</strong>等症状</li>
                </ul>
            </div>
        </div>

        <!-- CTA -->
        <div style="text-align:center;background:var(--bg-warm);padding:40px;border-radius:var(--radius);">
            <h2 style="margin-bottom:16px;">不确定自己的情况？</h2>
            <p style="font-size:1.1rem;color:var(--text-gray);margin-bottom:24px;">
                自评只是第一步，准确的诊断需要专业医生的评估。<br>
                翁青山博士为您提供一对一私密评估，明确ED类型后再制定治疗方案。
            </p>
            <a href="<?php echo home_url('/contact'); ?>" class="btn btn-primary btn-large">预约免费初诊评估</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
