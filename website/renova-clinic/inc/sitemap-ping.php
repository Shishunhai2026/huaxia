<?php
/**
 * Sitemap 自动提交 — 百度 & Google & 必应
 *
 * 在 WordPress 页面更新后自动 ping 搜索引擎的 sitemap 端点。
 * 也支持命令行手动触发。
 */

if (!defined('ABSPATH') && php_sapi_name() !== 'cli') exit;

// 搜索引擎 sitemap 提交端点
function renova_get_sitemap_ping_endpoints() {
    return array(
        'Baidu'    => 'https://www.baidu.com/ping?sitemap=https://www.csrenova.com/sitemap.xml',
        'Google'   => 'https://www.google.com/ping?sitemap=https://www.csrenova.com/sitemap.xml',
        'Bing'     => 'https://www.bing.com/indexnow?url=https://www.csrenova.com/sitemap.xml&key=www.csrenova.com',
    );
}

function renova_ping_sitemap() {
    $results = array();
    foreach (renova_get_sitemap_ping_endpoints() as $name => $endpoint) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT      => 'WordPress/sitemap-ping',
        ));
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $results[$name] = $httpCode;
    }
    return $results;
}

// ===== WordPress: 每24小时最多 ping 一次 =====
function renova_sitemap_auto_ping() {
    $last_ping = get_option('renova_sitemap_last_ping', 0);
    if (time() - $last_ping < 86400) return; // 24小时内不重复 ping

    renova_ping_sitemap();
    update_option('renova_sitemap_last_ping', time());
}
add_action('save_post', 'renova_sitemap_auto_ping');

// ===== 命令行模式 =====
if (php_sapi_name() === 'cli') {
    echo "Pinging sitemap to search engines...\n";
    $results = renova_ping_sitemap();
    foreach ($results as $name => $code) {
        echo "  {$name}: HTTP {$code}\n";
    }
    echo "Done.\n";
}
