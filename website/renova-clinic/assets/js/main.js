/**
 * Renova Clinic - Main JavaScript
 * 刘建军中西医诊所 主题脚本
 */
(function() {
    'use strict';

    // DOM加载完成后执行
    document.addEventListener('DOMContentLoaded', function() {

        // === 移动端菜单切换 ===
        var menuToggle = document.querySelector('.mobile-menu-toggle');
        var mainNav = document.querySelector('.main-nav');

        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                mainNav.classList.toggle('open');
                var expanded = mainNav.classList.contains('open');
                menuToggle.setAttribute('aria-expanded', expanded);
                menuToggle.innerHTML = expanded ? '✕' : '☰';
            });

            // 点击菜单外关闭
            document.addEventListener('click', function(e) {
                if (!mainNav.contains(e.target) && !menuToggle.contains(e.target)) {
                    mainNav.classList.remove('open');
                    menuToggle.innerHTML = '☰';
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // === FAQ折叠 ===
        var faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(function(question) {
            question.addEventListener('click', function() {
                var faqItem = this.parentElement;
                faqItem.classList.toggle('open');
            });
        });

        // === 平滑滚动 ===
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                var href = this.getAttribute('href');
                if (href === '#') return;
                var target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // === 表单验证 ===
        var contactForm = document.querySelector('.contact-form form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                var phone = this.querySelector('input[name="phone"]');
                var name = this.querySelector('input[name="name"]');
                var hasError = false;

                // 清除旧错误
                this.querySelectorAll('.form-error').forEach(function(el) {
                    el.remove();
                });

                if (name && !name.value.trim()) {
                    showError(name, '请输入您的姓名');
                    hasError = true;
                }

                if (phone && !phone.value.trim()) {
                    showError(phone, '请输入您的联系电话');
                    hasError = true;
                } else if (phone && !/^1[3-9]\d{9}$/.test(phone.value.trim())) {
                    showError(phone, '请输入正确的手机号码');
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                }
            });
        }

        function showError(field, message) {
            var error = document.createElement('div');
            error.className = 'form-error';
            error.style.cssText = 'color:#e74c3c;font-size:0.85rem;margin-top:4px;';
            error.textContent = message;
            field.parentNode.appendChild(error);
            field.style.borderColor = '#e74c3c';
            field.addEventListener('input', function() {
                field.style.borderColor = '';
                var err = field.parentNode.querySelector('.form-error');
                if (err) err.remove();
            }, {once: true});
        }

        // === 统计数字动画 ===
        var statsSection = document.querySelector('.stats-row');
        if (statsSection) {
            var animated = false;
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting && !animated) {
                        animated = true;
                        animateStats();
                    }
                });
            }, {threshold: 0.5});

            observer.observe(statsSection);
        }

        function animateStats() {
            var numbers = document.querySelectorAll('.stat-number');
            numbers.forEach(function(el) {
                var text = el.textContent;
                var match = text.match(/^(\d+)(.*)$/);
                if (match) {
                    var target = parseInt(match[1]);
                    var suffix = match[2] || '';
                    var current = 0;
                    var duration = 1500;
                    var start = performance.now();

                    function update(now) {
                        var elapsed = now - start;
                        var progress = Math.min(elapsed / duration, 1);
                        // easeOutExpo
                        progress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                        current = Math.round(target * progress);
                        el.innerHTML = current + '<small style="font-size:0.5em;color:var(--text-light);">' + suffix + '</small>';
                        if (progress < 1) {
                            requestAnimationFrame(update);
                        }
                    }
                    requestAnimationFrame(update);
                }
            });
        }

        // === 回到顶部 ===
        var backToTop = document.createElement('button');
        backToTop.innerHTML = '↑';
        backToTop.setAttribute('aria-label', '回到顶部');
        backToTop.style.cssText = 'position:fixed;bottom:30px;right:30px;width:48px;height:48px;background:var(--primary);color:#fff;border:none;border-radius:50%;font-size:1.5rem;cursor:pointer;display:none;z-index:999;box-shadow:0 4px 16px rgba(139,69,19,0.3);transition:all 0.3s ease;';
        document.body.appendChild(backToTop);

        window.addEventListener('scroll', function() {
            if (window.scrollY > 500) {
                backToTop.style.display = 'block';
                backToTop.style.opacity = '1';
            } else {
                backToTop.style.opacity = '0';
                setTimeout(function() {
                    if (window.scrollY <= 500) {
                        backToTop.style.display = 'none';
                    }
                }, 300);
            }
        });

        backToTop.addEventListener('click', function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        });

        backToTop.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 6px 20px rgba(139,69,19,0.4)';
        });

        backToTop.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 16px rgba(139,69,19,0.3)';
        });
    });

})();
