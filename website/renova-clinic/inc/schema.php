<?php
/**
 * Schema结构化数据生成器
 *
 * 为百度、Google、AI搜索引擎生成结构化数据标记
 */

if (!defined('ABSPATH')) exit;

/**
 * 获取诊所Schema标记
 * 用于所有页面
 */
function renova_get_clinic_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@graph' => array(
            // 诊所信息
            array(
                '@type' => 'MedicalClinic',
                '@id' => home_url('/#clinic'),
                'name' => '真颜堂中医诊所',
                'description' => '专业治疗血管性勃起功能障碍（ED），引进以色列Renova线性冲击波治疗仪。位于长沙市雨花区沙湾路品缦芸酒店5楼，翁青山博士亲自坐诊。',
                'url' => home_url(),
                'telephone' => get_option('renova_phone', ''),
                'address' => array(
                    '@type' => 'PostalAddress',
                    'addressLocality' => '长沙市',
                    'addressRegion' => '湖南省',
                    'streetAddress' => get_option('renova_address', '长沙市雨花区沙湾路品缦芸酒店5楼'),
                    'addressCountry' => 'CN',
                ),
                'openingHours' => 'Mo-Sa 08:30-17:30',
                'medicalSpecialty' => '男科',
                'availableService' => array(
                    array(
                        '@type' => 'MedicalProcedure',
                        'name' => 'Renova线性冲击波ED治疗',
                        'description' => '使用以色列Renova体外线性冲击波治疗仪，通过低能量冲击波促进阴茎海绵体血管新生，治疗血管性勃起功能障碍。非侵入性，有效率90%以上。',
                        'procedureType' => 'NoninvasiveProcedure',
                    ),
                ),
            ),
            // 医生信息
            array(
                '@type' => 'Physician',
                '@id' => home_url('/about#doctor'),
                'name' => '翁青山',
                'medicalSpecialty' => '男科',
                'affiliation' => array(
                    '@type' => 'MedicalClinic',
                    'name' => '真颜堂中医诊所',
                ),
            ),
            // 网站信息
            array(
                '@type' => 'WebSite',
                '@id' => home_url('/#website'),
                'url' => home_url(),
                'name' => '真颜堂中医诊所 - Renova冲击波ED治疗',
                'description' => '长沙专业ED治疗诊所，Renova线性冲击波，非侵入血管性勃起功能障碍治疗。',
                'inLanguage' => 'zh-CN',
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
    echo "\n<!-- Schema Structured Data -->\n";
    echo '<script type="application/ld+json">' . "\n";
    echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    echo "\n</script>\n";
}

/**
 * 获取FAQ Schema
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
 * 获取Article Schema（用于科普文章）
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
            'name' => '真颜堂中医诊所',
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
