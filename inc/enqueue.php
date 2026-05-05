<?php

function my_team_enqueue() {
    // ファイルの最終更新日時をバージョン番号にする（自動キャッシュクリア）
    $css_ver = filemtime(get_theme_file_path('/assets/css/main.css'));
    $js_ver  = filemtime(get_theme_file_path('/assets/js/main.js'));

    // CSSの読み込み
    wp_enqueue_style(
        'main-style',
        get_theme_file_uri('/assets/css/main.css'),
        [],
        $css_ver // 更新するたびに数値が変わるので、確実に最新が読み込まれます
    );

    // JavaScriptの読み込み
    wp_enqueue_script(
        'main-js',
        get_theme_file_uri('/assets/js/main.js'),
        [],
        $js_ver,
        true // </body>直前で読み込み（推奨）
    );
}

add_action('wp_enqueue_scripts', 'my_team_enqueue');