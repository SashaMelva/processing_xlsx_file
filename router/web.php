<?php

use App\Controllers\ExportDataForExcel;
use App\Controllers\TemplateView;

if (isset($_SERVER['REQUEST_URI'])) {
    try {
        switch ($_SERVER['REQUEST_URI']) {
            case '/' :
                (new TemplateView())->showMain();
                break;
            case '/export' :
                (new ExportDataForExcel())->export();
                break;
            case '/result' :
                (new TemplateView())->showResult();
                break;
        }
    } catch (Exception $e) {
        (new TemplateView())->showNotFound();
    }
}