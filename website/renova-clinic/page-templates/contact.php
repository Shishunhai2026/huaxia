<?php
/**
 * Template Name: 联系我们
 *
 * 包含：预约表单、诊所地址、百度地图、联系方式
 * 转化率最高的页面
 */
get_header();
renova_breadcrumb();
?>

<section class="page-header">
    <div class="container">
        <h1>联系我们 / 预约咨询</h1>
        <p class="page-desc">私密就诊环境 · 一对一专业咨询 · 严格保护隐私</p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="contact-grid">
            <!-- 联系信息 -->
            <div>
                <div class="contact-info-card" style="margin-bottom:24px;">
                    <h3 style="margin-bottom:24px;">就诊信息</h3>
                    <div class="contact-info-item">
                        <div class="icon">📍</div>
                        <div>
                            <h4>诊所地址</h4>
                            <p><?php echo get_option('renova_address', '长沙市雨花区沙湾路品缦芸酒店5楼（详细地址请致电或微信咨询，确保私密就诊）'); ?></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="icon">📞</div>
                        <div>
                            <h4>咨询电话</h4>
                            <p><?php echo get_option('renova_phone', '请致电预约'); ?></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="icon">🕐</div>
                        <div>
                            <h4>就诊时间</h4>
                            <p>周一至周六 8:30 - 17:30<br><small>周日休息，节假日另行通知</small></p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="icon">🚇</div>
                        <div>
                            <h4>交通方式</h4>
                            <p>公交/地铁可达 · 免费停车<br><small>为保护隐私，请提前预约，确保独立就诊时间</small></p>
                        </div>
                    </div>
                </div>

                <div style="background:var(--bg-warm);padding:24px;border-radius:var(--radius);border-left:4px solid var(--primary);">
                    <h4 style="color:var(--primary);">🔒 隐私保护承诺</h4>
                    <p style="color:var(--text-gray);font-size:0.95rem;">
                        我们深知男性健康问题的敏感性。本诊所实行<strong>一对一私密诊室</strong>制度，
                        所有就诊信息严格保密。您可以放心就诊，无需担心隐私泄露。
                    </p>
                </div>
            </div>

            <!-- 预约表单 -->
            <div class="contact-form">
                <h3 style="margin-bottom:8px;">在线预约咨询</h3>
                <p style="color:var(--text-gray);margin-bottom:24px;">填写以下信息，我们将在24小时内与您联系确认</p>
                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action" value="renova_contact_form">
                    <?php wp_nonce_field('renova_contact', 'renova_contact_nonce'); ?>
                    <div class="form-group">
                        <label for="name">您的称呼 *</label>
                        <input type="text" id="name" name="name" placeholder="请输入您的称呼（可使用化名）" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">联系电话 *</label>
                        <input type="tel" id="phone" name="phone" placeholder="请输入您的手机号码" required>
                    </div>
                    <div class="form-group">
                        <label for="age">年龄范围</label>
                        <select id="age" name="age">
                            <option value="">请选择</option>
                            <option value="18-29">18-29岁</option>
                            <option value="30-39">30-39岁</option>
                            <option value="40-49">40-49岁</option>
                            <option value="50-59">50-59岁</option>
                            <option value="60+">60岁以上</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="concern">您关心的问题</label>
                        <select id="concern" name="concern">
                            <option value="">请选择</option>
                            <option value="ed-treatment">勃起功能障碍（ED）治疗</option>
                            <option value="ed-evaluation">ED评估/检查</option>
                            <option value="maintenance">男性功能保养</option>
                            <option value="pde5i-failure">药物效果不佳/寻求替代方案</option>
                            <option value="consultation">其他咨询</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">留言（选填）</label>
                        <textarea id="message" name="message" rows="3" placeholder="如有补充信息或特殊需求，请在此说明"></textarea>
                    </div>
                    <p class="form-privacy">
                        🔒 您的信息仅用于就诊预约，不会用于任何其他用途
                    </p>
                    <button type="submit" class="btn btn-primary" style="width:100%;">提交预约</button>
                </form>
            </div>
        </div>

        <!-- 百度地图 -->
        <div class="map-container" style="margin-top:40px;">
            <!-- 替换为诊所实际百度地图嵌入代码 -->
            <div style="width:100%;height:400px;background:var(--bg-warm);display:flex;align-items:center;justify-content:center;color:var(--text-light);border-radius:var(--radius);">
                <div style="text-align:center;">
                    <p style="font-size:3rem;">🗺️</p>
                    <p>百度地图将在此显示</p>
                    <p style="font-size:0.85rem;">← 上线后替换为诊所百度地图嵌入代码</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
