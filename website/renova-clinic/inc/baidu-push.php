<?php
/**
 * 百度搜索资源平台 - URL主动推送 (实时)
 *
 * 配置步骤：
 * 1. 登录 https://ziyuan.baidu.com/linksubmit/ 添加站点 www.csrenova.com
 * 2. 在"链接提交" → "主动推送"中复制接口地址中的 token
 * 3. 将 token 填入下方的 RENOVA_BAIDU_PUSH_TOKEN
 *
 * 使用方式：
 * - WordPress: 页面发布/更新时自动推送
 * - 命令行: php baidu-push.php          (推送所有页面)
 * - 命令行: php baidu-push.php --url=https://www.csrenova.com/treatment  (推送单页)
 */

define('RENOVA_BAIDU_PUSH_TOKEN', ''); // 填入百度站长平台的推送 token

// 所有需要推送的页面 URL
function renova_baidu_get_all_urls() {
    // Core pages
    $urls = array(
        'https://www.csrenova.com/',
        'https://www.csrenova.com/treatment',
        'https://www.csrenova.com/pricing',
        'https://www.csrenova.com/treatment-comparison',
        'https://www.csrenova.com/symptom-check',
        'https://www.csrenova.com/mens-health',
        'https://www.csrenova.com/about',
        'https://www.csrenova.com/disease-science',
        'https://www.csrenova.com/clinical-evidence',
        'https://www.csrenova.com/faq',
        'https://www.csrenova.com/patient-cases',
        'https://www.csrenova.com/contact',
    );

    // Dynamically add article URLs
    $articles_dir = get_template_directory() . '/articles/';
    if (is_dir($articles_dir)) {
        $files = glob($articles_dir . '*.html');
        foreach ($files as $file) {
            $basename = basename($file, '.html');
            if (preg_match('/^\d+-(.+)$/', $basename, $m)) {
                $urls[] = 'https://www.csrenova.com/disease-science/' . $m[1] . '/';
            }
        }
    }

    return $urls;
}

// 百度主动推送 API
function renova_baidu_push_urls($urls) {
    $token = RENOVA_BAIDU_PUSH_TOKEN;
    if (empty($token)) {
        return array('error' => 'Token not configured. Set RENOVA_BAIDU_PUSH_TOKEN first.');
    }

    $api = "http://data.zz.baidu.com/urls?site=www.csrenova.com&token={$token}";
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL            => $api,
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS     => implode("\n", $urls),
        CURLOPT_HTTPHEADER     => array('Content-Type: text/plain'),
        CURLOPT_TIMEOUT        => 30,
    ));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $result = json_decode($response, true);
    return array(
        'http_code' => $httpCode,
        'response'  => $result,
        'pushed'    => $result['success'] ?? 0,
        'remaining' => $result['remain'] ?? 0,
    );
}

// ===== WordPress 集成 =====
if (defined('ABSPATH')) {
    /**
     * 发布/更新页面时自动推送到百度
     */
    function renova_baidu_push_on_publish($post_id, $post, $update) {
        if ($post->post_type !== 'page' || $post->post_status !== 'publish') return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (empty(RENOVA_BAIDU_PUSH_TOKEN)) return;

        $url = get_permalink($post_id);
        renova_baidu_push_urls(array($url));
    }
    add_action('save_post', 'renova_baidu_push_on_publish', 10, 3);
}

// ===== 命令行模式 =====
if (php_sapi_name() === 'cli') {
    $options = getopt('', array('url:'));

    if (empty(RENOVA_BAIDU_PUSH_TOKEN)) {
        echo "Error: RENOVA_BAIDU_PUSH_TOKEN not set.\n";
        echo "1. Go to https://ziyuan.baidu.com/linksubmit/\n";
        echo "2. Copy the token from '主动推送' API URL\n";
        echo "3. Paste it into this file\n";
        exit(1);
    }

    if (isset($options['url'])) {
        $urls = array($options['url']);
    } else {
        $urls = renova_baidu_get_all_urls();
    }

    echo "Pushing " . count($urls) . " URLs to Baidu...\n";
    foreach (array_chunk($urls, 10) as $batch) {
        $result = renova_baidu_push_urls($batch);
        echo "Batch: HTTP {$result['http_code']}, pushed {$result['pushed']}, remaining quota {$result['remaining']}\n";
    }
    echo "Done.\n";
}
