<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PageRenderTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function main_web_pages_render_successfully(): void
    {
        foreach ([
            '/',
            '/login',
            '/registro',
            '/admin',
            '/user',
            '/vista/clientes',
            '/vista/consultorias',
            '/vista/servicios',
            '/vista/solicitudes',
            '/vista/usuarios',
        ] as $path) {
            $this->get($path)->assertOk();
        }
    }
}
