<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

    /**
    * Override the view method to add custom behavior
    *
    * @param string $view
    * @param array $vars
    * @param bool $return
    * @return mixed
    */
    public function view($view, $vars = [], $return = FALSE)
    {
        $ci =& get_instance();
        $usingBenchmark = $ci->config->item('using_benchmark');
        $isDevelopment = ENVIRONMENT === 'development';

        if ($usingBenchmark && $isDevelopment) {
            $ci->output->enable_profiler(TRUE);
            $sections = [
                'config'  => TRUE,
                'queries' => TRUE,
                'post' => true,
                'memory_usage' => true,
                'http_headers' => true,
                'controller_info' => true,
                'benchmarks' => true,
            ];
            $ci->output->set_profiler_sections($sections);
        }

        // Call the parent view method to actually load the view
        $output = parent::view($view, $vars, $return);

        // Return the output if requested, otherwise return void
        return $output;
    }
}
        