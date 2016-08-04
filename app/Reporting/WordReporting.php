<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 27/07/2016 09:52
 * Copyright etech consulting 2016
 */

namespace App\Reporting;

use App\Helpers\Debugger;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;

class WordReporting
{

    /**
     * @param $name
     * @param $options
     * @param string $type
     * @param bool $replace
     * @return array
     */
    public static function render($name, $options, $type = 'fournisseur', $replace = false)
    {
        //$template = 'template_lettre_fournisseur';
        $root = realpath(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'files');

        Settings::setTempDir($root . DIRECTORY_SEPARATOR . 'temps');

        $templates = $root . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $options['template'] . '.docx';

        if (file_exists($templates)) {
            $template = new TemplateProcessor($templates);
            if (!empty($options)) {
                foreach ($options as $key => $value) {
                    $template->setValue($key, $value);
                }
            }

            $reportsDir = $root . DIRECTORY_SEPARATOR . 'reports';

            if ($type != null) {
                $reportsDir .= DIRECTORY_SEPARATOR . $type;

                if (!is_dir($reportsDir)) {
                    //Debugger::dd($reportsDir);
                    mkdir($reportsDir, 0777);
                }

                if (is_array($name)) {
                    $name = implode('_', $name);
                }

                $output = $type . '_' . $name;//. '_' . date('YmdHms');

                $output = $reportsDir . DIRECTORY_SEPARATOR . $output . '.docx';

                if (!file_exists($output) || $replace) {
                    $template->saveAs($output);
                }

                $output = str_replace($_SERVER['DOCUMENT_ROOT'], '', $output);

                return array('result' => $output, 'error' => false);
            }
        }
        return array('result' => null, 'error' => true);
    }
}