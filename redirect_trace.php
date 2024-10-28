<?php
add_filter( 'x_redirect_by', 'wp_redirect_custom_log', 10, 3 );

function wp_redirect_custom_log( $x_redirect_by, $location, $status ) {

    $traces = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT );
    $plugin_trace = array();

    foreach ( $traces as $trace ) {
        if( isset( $trace['file'] ) && strpos( $trace['file'], '/plugins/' ) > 0 ) {
            $file = explode( '/plugins/', $trace['file'] );
            if( substr( $file[1], 0, 22 ) != 'wp_redirect_custom_log' ) {
                $plugin_trace[] = $file[1] . ':' . $trace['line'];
            }
        }
    }

    $trace = date_i18n( 'Y-m-d H:i:s ', current_time( 'timestamp' ));
    $trace .= 'redirect by ' . $x_redirect_by . ', ' . $location . ', ' .  $status . ', ';
    $trace .= 'stack trace: ' . implode( ', ', $plugin_trace );
    file_put_contents( WP_CONTENT_DIR . '/debug.log', $trace . chr(13), FILE_APPEND  );

    return $x_redirect_by;
}
