<?php
/**
 * Schema结构化数据生成器
 *
 * 为百度、Google、AI搜索引擎（豆包/Kimi/秘塔）生成结构化数据标记
 * 基于《长沙市ED治疗关键词调研报告》进行GEO优化
 */

if (!defined('ABSPATH')) exit;

/**
 * 获取诊所Schema标记（增强版 - GEO优化）
 * 用于所有页面，包含完整实体图谱
 */
function renova_get_clinic_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@graph' => array(
            // 诊所信息（增强版）
            array(
                '@type' => 'MedicalClinic',
                '@id' => home_url('/#clinic'),
                'name' => '星沙华夏医院',
                'description' => '专业治疗血管性勃起功能障碍（ED），引进以色列Renova线性冲击波治疗仪（国械注进20173095171）。位于长沙县星沙镇北斗路16号（星沙汽车站斜对面），翁青山博士亲自坐诊。非侵入性治疗，轻中度ED有效率90%以上，PDE5i无效患者有效率60%+。',
                'url' => home_url(),
                'telephone' => get_option('renova_phone', '15909415555'),
                'priceRange' => '9600元/疗程',
                'address' => array(
                    '@type' => 'PostalAddress',
                    'addressLocality' => '长沙市',
                    'addressRegion' => '湖南省',
                    'streetAddress' => get_option('renova_address', '长沙县星沙镇北斗路16号（星沙汽车站斜对面）'),
                    'addressCountry' => 'CN',
                ),
                'openingHours' => 'Mo-Sa 08:30-17:30',
                'medicalSpecialty' => '男科',
                'areaServed' => array(
                    array('@type' => 'City', 'name' => '长沙市'),
                    array('@type' => 'City', 'name' => '长沙县'),
                    array('@type' => 'AdministrativeArea', 'name' => '芙蓉区'),
                    array('@type' => 'AdministrativeArea', 'name' => '岳麓区'),
                    array('@type' => 'AdministrativeArea', 'name' => '雨花区'),
                    array('@type' => 'AdministrativeArea', 'name' => '天心区'),
                    array('@type' => 'AdministrativeArea', 'name' => '开福区'),
                    array('@type' => 'AdministrativeArea', 'name' => '望城区'),
                ),
                'hasOfferCatalog' => array(
                    '@type' => 'OfferCatalog',
                    'name' => 'Renova冲击波ED治疗',
                    'itemListElement' => array(
                        array(
                            '@type' => 'Offer',
                            'itemOffered' => array(
                                '@type' => 'MedicalProcedure',
                                'name' => 'Renova线性冲击波ED治疗（单疗程）',
                                'description' => '4次治疗，每周1次，每次20分钟',
                            ),
                            'price' => '9600',
                            'priceCurrency' => 'CNY',
                        ),
                    ),
                ),
                'availableService' => array(
                    array(
                        '@type' => 'MedicalProcedure',
                        'name' => 'Renova线性冲击波ED治疗',
                        'description' => '使用以色列Renova体外线性冲击波治疗仪（国械注进20173095171），通过低能量冲击波（0.09mJ/mm²）促进阴茎海绵体血管新生，治疗血管性勃起功能障碍。非侵入性，轻中度ED有效率90%以上，PDE5i无效患者有效率60%+。',
                        'procedureType' => 'NoninvasiveProcedure',
                    ),
                ),
            ),
            // 医生信息（增强版）
            array(
                '@type' => 'Physician',
                '@id' => home_url('/about#doctor'),
                'name' => '翁青山',
                'honorificPrefix' => '博士',
                'medicalSpecialty' => '男科',
                'description' => '翁青山博士从事中西医结合临床工作10余年，具有丰富的男科疾病诊疗经验，擅长运用中西医结合方法诊断和治疗勃起功能障碍（ED），尤其在Renova线性冲击波ED治疗方面积累了丰富的临床经验。',
                'memberOf' => array(
                    '@type' => 'MedicalClinic',
                    '@id' => home_url('/#clinic'),
                    'name' => '星沙华夏医院',
                ),
                'affiliation' => array(
                    '@type' => 'MedicalClinic',
                    'name' => '星沙华夏医院',
                ),
                'knowsAbout' => array(
                    '勃起功能障碍',
                    'ED治疗',
                    'Renova冲击波治疗',
                    '男性性功能障碍',
                    '中西医结合男科',
                ),
            ),
            // 网站信息
            array(
                '@type' => 'WebSite',
                '@id' => home_url('/#website'),
                'url' => home_url(),
                'name' => '星沙华夏医院 - Renova冲击波ED治疗',
                'description' => '长沙专业ED治疗诊所，Renova线性冲击波，非侵入血管性勃起功能障碍治疗。',
                'inLanguage' => 'zh-CN',
                'potentialAction' => array(
                    '@type' => 'SearchAction',
                    'target' => home_url('/?s={search_term_string}'),
                    'query-input' => 'required name=search_term_string',
                ),
            ),
        ),
    );

    return $schema;
}

/**
 * 输出诊所Schema
 */
function renova_output_clinic_schema() {
    $schema = renova_get_clinic_schema();
    echo "\n<!-- Schema Structured Data (GEO Enhanced) -->\n";
    echo '<script type="application/ld+json">' . "\n";
    echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    echo "\n</script>\n";
}

/**
 * 获取FAQ Schema（扩展版 - 20+问答）
 */
function renova_get_faq_schema($faqs) {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array(),
    );

    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = array(
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => $faq['answer'],
            ),
        );
    }

    return $schema;
}

/**
 * 获取HowTo Schema（治疗流程）
 */
function renova_get_howto_schema() {
    return array(
        '@context' => 'https://schema.org',
        '@type' => 'HowTo',
        'name' => 'Renova冲击波ED治疗流程',
        'description' => '星沙华夏医院Renova线性冲击波治疗勃起功能障碍（ED）的完整流程：初诊评估→制定方案→冲击波治疗→随访评估。',
        'step' => array(
            array(
                '@type' => 'HowToStep',
                'position' => 1,
                'name' => '初诊评估',
                'text' => '详细问诊+IIEF-EF量表评估+必要时阴茎彩色多普勒超声检查，确定ED类型和严重程度。',
            ),
            array(
                '@type' => 'HowToStep',
                'position' => 2,
                'name' => '制定治疗方案',
                'text' => '根据评估结果，确定冲击波治疗的次数、剂量和辅助方案（可单用Renova或联合低剂量PDE5i）。',
            ),
            array(
                '@type' => 'HowToStep',
                'position' => 3,
                'name' => '进行治疗（×4次）',
                'text' => '每周1次，每次约20分钟。治疗左右阴茎脚+左右阴茎海绵体4个部位，共3600-5000发冲击波。无需麻醉，基本无痛。',
            ),
            array(
                '@type' => 'HowToStep',
                'position' => 4,
                'name' => '随访评估效果',
                'text' => '疗程结束后1个月、3个月、6个月随访，评估IIEF-EF评分改善，根据情况决定是否需要第2疗程。',
            ),
        ),
        'totalTime' => 'P4W',
        'supply' => array(
            '@type' => 'HowToSupply',
            'name' => 'Renova线性冲击波治疗仪（国械注进20173095171）',
        ),
    );
}

/**
 * 获取BreadcrumbList Schema
 */
function renova_get_breadcrumb_schema($items) {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array(),
    );

    $position = 1;
    foreach ($items as $name => $url) {
        $schema['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => $position,
            'name' => $name,
            'item' => $url,
        );
        $position++;
    }

    return $schema;
}

/**
 * 获取Article Schema（用于科普文章 - 增强版含citation）
 */
function renova_get_article_schema() {
    if (!is_single()) return null;

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'MedicalWebPage',
        'headline' => get_the_title(),
        'description' => get_the_excerpt(),
        'datePublished' => get_the_date('c'),
        'dateModified' => get_the_modified_date('c'),
        'author' => array(
            '@type' => 'Person',
            'name' => '翁青山',
        ),
        'reviewedBy' => array(
            '@type' => 'Person',
            'name' => '翁青山',
        ),
        'publisher' => array(
            '@type' => 'MedicalClinic',
            'name' => '星沙华夏医院',
        ),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id' => get_permalink(),
        ),
    );

    if (has_post_thumbnail()) {
        $schema['image'] = get_the_post_thumbnail_url(null, 'large');
    }

    return $schema;
}

/**
 * 获取临床研究ItemList Schema（用于临床证据页）
 */
function renova_get_clinical_studies_schema() {
    return array(
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'name' => 'Renova冲击波治疗ED核心临床研究',
        'description' => '支持Renova线性冲击波治疗勃起功能障碍（ED）的核心临床研究证据汇总。',
        'itemListElement' => array(
            array(
                '@type' => 'ListItem',
                'position' => 1,
                'item' => array(
                    '@type' => 'MedicalScholarlyArticle',
                    'name' => 'Reisman Y, et al. Low-intensity shockwave therapy for ED',
                    'description' => '58例血管性ED患者，Renova治疗4次，轻中度ED有效率90.57%，轻度ED有效率100%。',
                    'publication' => array(
                        '@type' => 'PublicationEvent',
                        'name' => 'International Journal of Impotence Research',
                    ),
                    'datePublished' => '2015',
                ),
            ),
            array(
                '@type' => 'ListItem',
                'position' => 2,
                'item' => array(
                    '@type' => 'MedicalScholarlyArticle',
                    'name' => 'Bechara A, et al. Shockwave therapy for PDE5i non-responders',
                    'description' => '50例PDE5抑制剂无效ED患者，Renova治疗有效率60%，疗效持续12个月。',
                    'publication' => array(
                        '@type' => 'PublicationEvent',
                        'name' => 'Sexual Medicine',
                    ),
                    'datePublished' => '2016',
                ),
            ),
            array(
                '@type' => 'ListItem',
                'position' => 3,
                'item' => array(
                    '@type' => 'MedicalScholarlyArticle',
                    'name' => 'Clavijo RI, et al. Meta-analysis of Li-ESWT for ED',
                    'description' => '7项RCT共602例ED患者Meta分析：IIEF评分平均提升4.17分（p<0.0001），冲击波治疗效果显著优于安慰剂。',
                    'publication' => array(
                        '@type' => 'PublicationEvent',
                        'name' => 'Journal of Sexual Medicine',
                    ),
                    'datePublished' => '2017',
                ),
            ),
        ),
    );
}
