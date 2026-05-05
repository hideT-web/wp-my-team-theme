<?php
/*--------------------------------------
  ファイル読み込み
--------------------------------------*/
require get_theme_file_path('/inc/setup.php');
require get_theme_file_path('/inc/enqueue.php');

/*--------------------------------------
  バージョン（?ver=）削除
--------------------------------------*/
function my_remove_ver_query($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

// フロント側のみ適用（管理画面の不具合防止）
if (!is_admin()) {
    add_filter('style_loader_src', 'my_remove_ver_query', 9999);
    add_filter('script_loader_src', 'my_remove_ver_query', 9999);
}

/*--------------------------------------
  クリーンアップ
--------------------------------------*/
add_action('init', function () {

    // ブロックパターン削除（好みでON/OFF）
    remove_theme_support('core-block-patterns');

    // 絵文字削除
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
});

// WPバージョン非表示（セキュリティ）
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/*--------------------------------------
  ショートコード
--------------------------------------*/
// [copyright]
add_shortcode('copyright', function () {
    return sprintf(
        '&copy; %s <a href="%s">%s</a> All Rights Reserved.',
        date('Y'),
        esc_url(home_url('/')),
        esc_html(get_bloginfo('name'))
    );
});