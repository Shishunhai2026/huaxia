# 刘建军中西医诊所 — 网站部署与运营手册

## 📋 目录

1. [ICP备案指南](#1-icp备案指南)
2. [服务器环境搭建](#2-服务器环境搭建)
3. [WordPress安装](#3-wordpress安装)
4. [主题部署与配置](#4-主题部署与配置)
5. [页面创建与内容导入](#5-页面创建与内容导入)
6. [SEO优化配置](#6-seo优化配置)
7. [百度生态配置](#7-百度生态配置)
8. [日常运营指南](#8-日常运营指南)
9. [性能监控与优化](#9-性能监控与优化)

---

## 1. ICP备案指南

### ⚠️ 医疗网站必须完成ICP备案才能上线

**备案流程（阿里云）：**
1. 登录阿里云控制台 → 域名 → 备案
2. 选择"首次备案"，填写主体信息（个人或企业）
3. **网站名称建议**：使用"刘建军健康工作室"或"长沙XX健康咨询"，避免含"医疗""医院""诊所"字眼
4. 上传身份证、核验照
5. 提交审核，等待管局审批（约20个工作日）
6. 备案通过后，将备案号放在网站底部

**备案期间的工作：**
- ✅ 用服务器IP搭建测试环境开发网站
- ✅ 准备好所有页面内容和文章
- ❌ 不要用域名公开访问网站（备案前域名不能指向国内服务器）

---

## 2. 服务器环境搭建

### 推荐方案：阿里云 + 宝塔面板

**Step 1：安装宝塔面板**
```bash
# SSH登录阿里云ECS，执行：
yum install -y wget && wget -O install.sh http://download.bt.cn/install/install_6.0.sh && sh install.sh
```

**Step 2：安装环境（宝塔面板内一键安装）**
- Nginx 1.22+
- MySQL 5.7+
- PHP 7.4 或 8.0
- phpMyAdmin

**Step 3：PHP扩展确认**
确保以下扩展已启用：
- mysqli
- curl
- gd
- mbstring
- zip
- openssl

**Step 4：创建网站**
1. 宝塔面板 → 网站 → 添加站点
2. 域名：填入你的域名
3. 数据库：创建MySQL数据库（记录下数据库名、用户名、密码）
4. PHP版本：选7.4或8.0

---

## 3. WordPress安装

**Step 1：下载WordPress**
```bash
cd /www/wwwroot/YOUR_DOMAIN/
wget https://cn.wordpress.org/latest-zh_CN.zip
unzip latest-zh_CN.zip
mv wordpress/* ./
rm -rf wordpress latest-zh_CN.zip
```

**Step 2：配置wp-config.php**
1. 访问 http://YOUR_DOMAIN/
2. 按提示填入数据库信息
3. 设置站点标题：**刘建军中西医诊所**
4. 设置管理员账号密码（务必记录）

**Step 3：基础设置**
- 设置 → 常规：站点标题"刘建军中西医诊所 - Renova冲击波ED治疗"
- 设置 → 固定链接：选择"文章名"（`/%postname%/`）
- 设置 → 隐私：确保搜索引擎可索引

**Step 4：安装必要插件**
- **Rank Math SEO**（免费）- SEO优化，替代Yoast
- **WP Super Cache** 或 **W3 Total Cache**（免费）- 页面缓存加速
- **Wordfence Security**（免费）- 安全防护
- **Smush**（免费）- 图片压缩优化

---

## 4. 主题部署与配置

**Step 1：上传主题**
将 `renova-clinic/` 目录上传到：
```
/wp-content/themes/renova-clinic/
```

**Step 2：激活主题**
外观 → 主题 → 找到"Renova Clinic" → 激活

**Step 3：配置菜单**
外观 → 菜单 → 创建菜单
- 名称：主导航
- 添加以下页面链接：
  - 首页 → 自定义链接：`/`
  - 关于我们 → `/about`
  - 治疗项目 → `/treatment`
  - 疾病科普 → `/disease-science`
  - 临床证据 → `/clinical-evidence`
  - 治疗案例 → `/patient-cases`
  - 联系我们 → `/contact`
- 显示位置：勾选"主导航菜单"

**Step 4：设置首页**
设置 → 阅读 → 首页显示 → 选择"静态页面"
- 首页：选择"首页"（Front Page模板）
- 文章页：选择"疾病科普"

**Step 5：配置诊所信息**
在 `functions.php` 中或通过主题自定义设置：
- 诊所电话
- 诊所地址
- 营业时间

---

## 5. 页面创建与内容导入

### 需要创建的页面（使用对应的页面模板）：

| # | 页面标题 | Slug | 模板 |
|---|---------|------|------|
| 1 | 首页 | front-page | 默认（使用front-page.php） |
| 2 | 关于我们 | about | 关于我们 |
| 3 | 治疗项目 | treatment | 治疗项目 |
| 4 | 疾病科普 | disease-science | 疾病科普 |
| 5 | 治疗流程 | treatment-process | 默认 |
| 6 | 常见问题 | faq | FAQ |
| 7 | 临床证据 | clinical-evidence | 临床证据 |
| 8 | 治疗案例 | patient-cases | 治疗案例 |
| 9 | 联系我们 | contact | 联系我们 |
| 10 | 文献汇编 | literature | 默认 |

### 导入SEO文章：
1. WordPress后台 → 文章 → 导入
2. 将 `articles/` 目录下的HTML文件内容逐篇发布为文章
3. 选择分类：疾病科普
4. 添加对应的标签

文章发布清单：
- ✅ 01 - 冲击波治疗ED效果怎么样？
- ✅ 02 - ED不吃药能治好吗？
- ✅ 03 - PDE5抑制剂无效怎么办？
- ✅ 04 - 男性功能衰退怎么办？（保养指南）
- ✅ 05 - 血管性ED能治愈吗？
- ✅ 06 - 糖尿病导致ED怎么办？
- ✅ 07 - ED是心血管疾病的报警信号
- ✅ 08 - ED最新治疗方法全解析

---

## 6. SEO优化配置

### 6.1 Rank Math SEO设置

1. 安装激活Rank Math SEO插件
2. 完成设置向导：
   - 网站类型：Local Business → Medical Clinic
   - 公司名称：刘建军中西医诊所
   - Logo：上传诊所Logo
3. Title & Meta设置：
   - 首页标题：`长沙ED治疗 | 刘建军中西医诊所 - Renova冲击波`
   - 首页描述：`长沙岳麓区刘建军中西医诊所，以色列Renova线性冲击波治疗血管性ED，10年+临床经验，轻中度有效率90%+。`
   - 文章标题格式：`%title% - 刘建军中西医诊所`

### 6.2 上传Sitemap和Robots

将以下文件上传到网站根目录：
- `sitemap.xml` → `/www/wwwroot/YOUR_DOMAIN/sitemap.xml`
- `robots.txt` → `/www/wwwroot/YOUR_DOMAIN/robots.txt`
- `.htaccess` → `/www/wwwroot/YOUR_DOMAIN/.htaccess`（如果是Apache）

**重要：替换文件中的 YOUR_DOMAIN 为实际域名**

### 6.3 每页SEO检查清单

- [ ] 每个页面有唯一的Title标签
- [ ] 每个页面有独特的Meta Description（150字以内）
- [ ] H1标签仅出现一次
- [ ] 关键词自然地出现在前300字
- [ ] 图片有Alt文字
- [ ] 内链指向相关页面
- [ ] URL简短有意义

---

## 7. 百度生态配置

### 7.1 百度站长平台（必做）

1. 访问：https://ziyuan.baidu.com/
2. 注册账号，添加网站
3. 验证网站所有权（3种方式任选）：
   - HTML文件验证
   - Meta标签验证
   - CNAME解析验证
4. 提交sitemap.xml
5. 使用"手动提交"功能提交首页和各页面URL
6. 使用"抓取诊断"测试百度能否正常抓取

**百度站长平台日常任务：**
- 每周检查"索引量"
- 每月检查"抓取异常"
- 新页面发布后立即"手动提交"

### 7.2 百度地图标注

1. 访问：https://map.baidu.com/
2. 搜索你的诊所地址
3. 如未收录 → 点击"添加地点"
4. 填写：
   - 名称：刘建军中西医诊所
   - 分类：医疗 → 诊所
   - 地址：长沙市雨花区沙湾路品缦芸酒店5楼（详细地址）
   - 电话：你的咨询电话
5. 上传诊所照片
6. 提交审核

### 7.3 百家号（建议开通）

1. 注册百家号：https://baijiahao.baidu.com/
2. 选择"健康"领域
3. 将网站文章同步发布到百家号（可适当改写）
4. 百家号文章末尾可注明"了解更多请访问XX网站"
5. 百家号内容在百度搜索中有优先展示权重

### 7.4 百度百科

尝试创建以下词条（如不存在）：
- "Renova冲击波" 或 "体外线性冲击波治疗仪"
- 词条内容需客观、有引用来源
- 注意不要有广告嫌疑

---

## 8. 日常运营指南

### 8.1 内容更新计划（每月4-6篇）

**文章主题建议：**
- ED相关常见问题解答（每周1篇）
- 男性健康科普（每周1篇）
- 季节相关男科问题（如"夏季ED高发的原因"）
- 疾病与ED的关系（糖尿病/高血压/肥胖等）
- 患者关心的生活方式问题（饮食/运动/睡眠）

### 8.2 文章SEO规范

每篇文章发布前确认：
- [ ] 目标关键词出现在标题中
- [ ] 目标关键词出现在第一段
- [ ] 有至少2个子标题（H2/H3）
- [ ] 文章长度800字以上
- [ ] 有1-2张相关图片（带Alt）
- [ ] 结尾有CTA（引导咨询/预约）
- [ ] Meta Description已填写

### 8.3 外链建设（持续进行）

- 在知乎、丁香园等平台回答问题，适当时附上网站链接
- 与本地健康类公众号合作互推
- 在长沙本地论坛（如红网论坛、长沙通）发布科普+链接
- 如有合作医院或机构，互相添加友情链接

### 8.4 数据分析（每月）

- 百度站长平台：查看搜索词、点击量、排名
- 网站访问统计：UV、PV、访问来源
- 重点关注：哪些关键词带来了流量和咨询
- 根据数据调整内容策略

---

## 9. 性能监控与优化

### 9.1 加载速度目标
- 首页加载 < 3秒
- 内页加载 < 2秒
- 移动端加载 < 3秒

### 9.2 优化措施
- 启用WP Super Cache页面缓存
- 图片使用WebP格式（Smush插件自动转换）
- 使用CDN加速（阿里云CDN或Cloudflare）
- 数据库定期优化（WP-Optimize插件）

### 9.3 安全维护
- WordPress核心、插件、主题保持最新版本
- 定期备份（宝塔面板可设置自动备份）
- 使用强密码，定期更换
- 安装Wordfence安全插件

---

## 📞 技术支持

文件结构总览：
```
renova-clinic/
├── style.css              # 主题样式
├── functions.php          # 主题功能
├── header.php             # 页头
├── footer.php             # 页脚
├── index.php              # 博客列表
├── front-page.php         # 首页模板
├── page.php              # 通用页面
├── single.php            # 文章详情
├── page-templates/        # 页面模板
│   ├── about.php         # 关于我们
│   ├── treatment.php     # 治疗项目
│   ├── disease-science.php # 疾病科普
│   ├── clinical-evidence.php # 临床证据
│   ├── faq.php           # FAQ
│   ├── patient-cases.php # 治疗案例
│   └── contact.php       # 联系我们
├── inc/
│   └── schema.php        # Schema结构化数据
├── assets/
│   ├── css/home.css      # 首页额外样式
│   └── js/main.js        # 主题JS
├── articles/              # SEO文章（导入用）
│   ├── 01-chongjibo-ED-xiaoguo.html
│   ├── 02-ED-bu-chiyao.html
│   ├── 03-PDE5i-wuxiao.html
│   ├── 04-nanxing-baoyang.html
│   ├── 05-xueguanxing-ED.html
│   ├── 06-tangniaobing-ED.html
│   ├── 07-ED-xinxueguan.html
│   └── 08-ED-zhiliao-zonglan.html
├── sitemap.xml           # 网站地图
├── robots.txt            # 爬虫规则
└── .htaccess             # Apache配置
```

---

**最后更新时间：2026年6月1日**
**下次复查：每月第一个周一**
