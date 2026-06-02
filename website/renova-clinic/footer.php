    <footer class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>真颜堂中医诊所</h4>
                    <p>长沙市雨花区沙湾路品缦芸酒店5楼，专注男性健康10余年。<br>
                    引进以色列Renova线性冲击波治疗仪，<br>
                    专业治疗血管性勃起功能障碍（ED）。</p>
                    <p style="margin-top:12px;">
                        <span style="color:#fff;font-weight:600;">📞 <?php echo get_option('renova_phone', '咨询电话'); ?></span>
                    </p>
                </div>
                <div class="footer-col">
                    <h4>诊疗项目</h4>
                    <a href="<?php echo home_url('/treatment'); ?>">Renova冲击波治疗ED</a>
                    <a href="<?php echo home_url('/treatment-process'); ?>">治疗流程</a>
                    <a href="<?php echo home_url('/faq'); ?>">常见问题</a>
                    <a href="<?php echo home_url('/disease-science'); ?>">男性功能保养</a>
                </div>
                <div class="footer-col">
                    <h4>关于我们</h4>
                    <a href="<?php echo home_url('/about'); ?>">诊所简介</a>
                    <a href="<?php echo home_url('/about#doctor'); ?>">翁医生简介</a>
                    <a href="<?php echo home_url('/clinical-evidence'); ?>">临床证据</a>
                    <a href="<?php echo home_url('/patient-cases'); ?>">治疗案例</a>
                </div>
                <div class="footer-col">
                    <h4>就诊信息</h4>
                    <p>📍 <?php echo get_option('renova_address', '长沙市雨花区沙湾路品缦芸酒店5楼'); ?></p>
                    <p>🕐 周一至周六 8:30-17:30</p>
                    <p>🚇 公共交通可达，私密就诊环境</p>
                    <p>🅿️ 免费停车</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> 真颜堂中医诊所 版权所有 |
                    <a href="/sitemap.xml" style="color:rgba(255,255,255,0.4);">网站地图</a> |
                    本站内容仅供参考，不能替代专业医疗诊断
                </p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
