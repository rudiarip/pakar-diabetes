<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Determine whether to use the profiler or not
 *
 * If using_benchmark is true, and project is in production, the profiler will not be shown
 * If using_benchmark is true, and project is in development, the profiler will be shown
 * If using_benchmark is false, the profiler will not be shown regardless if project is in production or development
 */
$config['using_benchmark']         = false; // true or false
