<?php

namespace Tests\Feature;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PageRenderTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function public_web_pages_render_successfully(): void
    {
        foreach ([
            '/',
            '/login',
            '/registro',
        ] as $path) {
            $this->get($path)->assertOk();
        }
    }

    #[Test]
    public function protected_web_pages_redirect_guests(): void
    {
        foreach ([
            '/admin',
            '/user',
            '/vista/clientes',
            '/vista/consultorias',
            '/vista/servicios',
            '/vista/solicitudes',
            '/vista/usuarios',
        ] as $path) {
            $this->get($path)->assertRedirect('/login');
        }
    }

    #[Test]
    public function protected_web_pages_render_for_authorized_users(): void
    {
        $admin = $this->userWithRole('ADMINISTRADOR');
        $cliente = $this->userWithRole('CLIENTE');

        foreach ([
            '/admin',
            '/vista/clientes',
            '/vista/consultorias',
            '/vista/solicitudes',
            '/vista/usuarios',
        ] as $path) {
            $this->actingAs($admin)->get($path)->assertOk();
        }

        foreach ([
            '/user',
            '/vista/servicios',
            '/vista/solicitudes',
        ] as $path) {
            $this->actingAs($cliente)->get($path)->assertOk();
        }
    }

    private function userWithRole(string $roleName): User
    {
        $role = Rol::create([
            'nombre' => $roleName,
            'descripcion' => $roleName,
        ]);

        return User::create([
            'nombre' => $roleName,
            'email' => strtolower($roleName).'@example.com',
            'password' => 'password',
            'rol_id' => $role->id,
        ]);
    }
}
