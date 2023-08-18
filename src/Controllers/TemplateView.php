<?php

namespace App\Controllers;

use App\Services\View;

class TemplateView
{
    public function showMain(): void
    {
        echo (new View(Template));
    }

    public function showNotFound(): void
    {
        echo (new View(NotFound));
    }

    public function showResult(): void
    {
        echo (new View(Result));
    }
}