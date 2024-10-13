<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('loadHeader'))
{
	/**
	 * Load HTTP Headers
	 * 
	 * @param bool $standard
	 * @param bool $extra
	 * 
	 * @return void
	 */
	function loadHeader($standard = false, $extra = false) {
		header_remove("X-Powered-By");
		if ($standard) {
			header('Cross-Origin-Opener-Policy: same-origin', TRUE);
			header('Cross-Origin-Resource-Policy: same-origin', TRUE);
			header('Cross-Origin-Embedder-Policy: require-corp', TRUE);
			header('X-DNS-Prefetch-Control: off', TRUE);
			header('X-Download-Options: noopen', TRUE);
			header('X-Permitted-Cross-Domain-Policies: none', TRUE);
			header('X-Content-Type-Options: nosniff', TRUE);
			header('X-Frame-Options: SAMEORIGIN', TRUE);
			header('Referrer-Policy: no-referrer', TRUE);
			header('Origin-Agent-Cluster: ?1', TRUE);
			// header("Content-Security-Policy: default-src 'self' 'unsafe-inline' *.gstatic.com *.googleapis.com *.openstreetmap.org *.unpkg.com *.cloudflare.com *.bootstrapcdn.com *.jquery.com cdn.jsdelivr.net api.ipify.org", TRUE);
			if (ENVIRONMENT === 'production') {
                // Prefer HTTPS over HTTP
				header('Strict-Transport-Security: max-age=15552000; includeSubDomains', TRUE);
			}
		}

		if ($extra) {
			header("Permissions-Policy: fullscreen=(self), geolocation=(self), camera=(self)", TRUE);
			header('Clear-Site-Data: "cache"', TRUE);
		}
	}
}

if (!function_exists('hideWarning')) {
    /**
     * Hide pesan warning
     *
     * @return void
     */
    function hideWarning()
    {
        if (ENVIRONMENT === 'development') {
            // Di atas PHP 7.3, PHPExcel ngasih banyak warning
            $version = explode('.', PHP_VERSION);
            if ($version[1] >= 3) {
                error_reporting(E_ERROR | E_PARSE);
            }
        }
    }
}

if (!function_exists('folder_permission')) {
    /**
     * Cek ada folder buat nampung file-nya apa enggak. Kalo gak ada, dibuat otomatis.
     *
     * @param string $path
     *  Ex: dirname(BASEPATH) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'legalitas-makloon');
     * @param string $mode  Default to 0775 (rwxrwxr-x). Gak pake 0777 (rwxrwxrwx) biar gak terlalu open folder-nya.
     * @param string $owner Default to apache.
     *
     * @return void
     */
    function folder_permission($path, $mode = 0775, $owner = 'apache')
    {
        // pake file_exists() juga bisa
        // kalo pake file_exists(), bisa buat cek file ada apa enggak
        if (!is_dir($path)) {
            $old = umask(0);
            mkdir($path, $mode, TRUE);
            @chown($path, $owner);
            @chgrp($path, $owner);
            umask($old);
        } else {
            // kalo udah ada folder-nya, cek permission-nya
            // kalo belom 0755, ganti permission-nya
            $old = umask(0);
            @chmod($path, $mode);
            @chown($path, $owner);
            @chgrp($path, $owner);
            umask($old);
        }
    }
}

