<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Consultoria;
use App\Models\Rol;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PanelController extends Controller
{
    private const ESTADOS_SOLICITUD = ['PENDIENTE', 'EN_PROCESO', 'FINALIZADA'];

    private function isAdmin(): bool
    {
        return Auth::user()?->rol?->nombre === 'ADMINISTRADOR';
    }

    private function authorizeSolicitud(Solicitud $solicitud): void
    {
        if (! $this->isAdmin() && $solicitud->user_id !== Auth::id()) {
            abort(403);
        }
    }

    public function clientes()
    {
        return view('cliente.index', ['clientes' => Cliente::orderBy('id')->get()]);
    }

    public function clienteForm(?Cliente $cliente = null)
    {
        $cliente ??= new Cliente();

        return view('cliente.form', [
            'cliente' => $cliente,
            'formTitle' => $cliente->exists ? 'Editar cliente' : 'Nuevo cliente',
            'formAction' => $cliente->exists ? url('/vista/clientes/editar/'.$cliente->id) : url('/vista/clientes/nuevo'),
        ]);
    }

    public function clienteStore(Request $request)
    {
        Cliente::create($this->validateCliente($request));

        return redirect('/vista/clientes')->with('successMessage', 'Cliente guardado correctamente.');
    }

    public function clienteUpdate(Request $request, Cliente $cliente)
    {
        $cliente->update($this->validateCliente($request, $cliente));

        return redirect('/vista/clientes')->with('successMessage', 'Cliente actualizado correctamente.');
    }

    public function clienteDestroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect('/vista/clientes')->with('successMessage', 'Cliente eliminado correctamente.');
    }

    public function consultorias()
    {
        return view('consultorias.index', ['consultorias' => Consultoria::orderBy('id')->get()]);
    }

    public function consultoriaForm(?Consultoria $consultoria = null)
    {
        $consultoria ??= new Consultoria();

        return view('consultorias.form', [
            'consultoria' => $consultoria,
            'formTitle' => $consultoria->exists ? 'Editar consultoria' : 'Nueva consultoria',
            'formAction' => $consultoria->exists ? url('/vista/consultorias/editar/'.$consultoria->id) : url('/vista/consultorias/nueva'),
        ]);
    }

    public function consultoriaStore(Request $request)
    {
        Consultoria::create($request->validate([
            'tipo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]));

        return redirect('/vista/consultorias')->with('successMessage', 'Consultoria guardada correctamente.');
    }

    public function consultoriaUpdate(Request $request, Consultoria $consultoria)
    {
        $consultoria->update($request->validate([
            'tipo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]));

        return redirect('/vista/consultorias')->with('successMessage', 'Consultoria actualizada correctamente.');
    }

    public function consultoriaDestroy(Consultoria $consultoria)
    {
        $consultoria->delete();

        return redirect('/vista/consultorias')->with('successMessage', 'Consultoria eliminada correctamente.');
    }

    public function servicios()
    {
        return view('solicitudes.servicios', ['consultorias' => Consultoria::orderBy('tipo')->get()]);
    }

    public function solicitudes()
    {
        $query = Solicitud::with(['cliente', 'consultoria'])->orderByDesc('id');

        if (! $this->isAdmin() && Auth::check()) {
            $query->where('user_id', Auth::id());
        }

        return view('solicitudes.index', [
            'solicitudes' => $query->get(),
            'isAdmin' => $this->isAdmin(),
        ]);
    }

    public function solicitudForm(?Solicitud $solicitud = null)
    {
        if ($solicitud?->exists) {
            $this->authorizeSolicitud($solicitud);
        }

        $solicitud ??= new Solicitud([
            'estado' => 'PENDIENTE',
            'fecha' => now()->toDateString(),
            'user_id' => Auth::id(),
            'nombre_solicitante' => Auth::user()?->nombre,
            'correo_solicitante' => Auth::user()?->email,
        ]);

        return view('solicitudes.form', [
            'solicitudForm' => $solicitud,
            'clientes' => Cliente::orderBy('nombre')->get(),
            'consultorias' => Consultoria::orderBy('tipo')->get(),
            'estadosSolicitud' => self::ESTADOS_SOLICITUD,
            'selectedCliente' => $solicitud->cliente,
            'isAdmin' => $this->isAdmin(),
            'isEdit' => $solicitud->exists,
            'formTitle' => $solicitud->exists ? 'Editar solicitud' : 'Nueva solicitud',
            'formAction' => $solicitud->exists ? url('/vista/solicitudes/editar/'.$solicitud->id) : url('/vista/solicitudes/nueva'),
        ]);
    }

    public function solicitudStore(Request $request)
    {
        Solicitud::create($this->validateSolicitud($request));

        return redirect('/vista/solicitudes')->with('successMessage', 'Solicitud guardada correctamente.');
    }

    public function solicitudUpdate(Request $request, Solicitud $solicitud)
    {
        $this->authorizeSolicitud($solicitud);

        $solicitud->update($this->validateSolicitud($request, $solicitud));

        return redirect('/vista/solicitudes')->with('successMessage', 'Solicitud actualizada correctamente.');
    }

    public function solicitudDestroy(Solicitud $solicitud)
    {
        $this->authorizeSolicitud($solicitud);

        $solicitud->delete();

        return redirect('/vista/solicitudes')->with('successMessage', 'Solicitud eliminada correctamente.');
    }

    public function usuarios()
    {
        return view('usuarios.index', ['usuarios' => User::with('rol')->orderBy('id')->get()]);
    }

    public function usuarioForm(?User $usuario = null)
    {
        $usuario ??= new User();

        return view('usuarios.form', [
            'usuarioForm' => $usuario,
            'roles' => Rol::orderBy('nombre')->get(),
            'isEdit' => $usuario->exists,
            'formTitle' => $usuario->exists ? 'Editar usuario' : 'Nuevo usuario',
            'formAction' => $usuario->exists ? url('/vista/usuarios/editar/'.$usuario->id) : url('/vista/usuarios/nuevo'),
        ]);
    }

    public function usuarioStore(Request $request)
    {
        $data = $this->validateUsuario($request);
        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect('/vista/usuarios')->with('successMessage', 'Usuario guardado correctamente.');
    }

    public function usuarioUpdate(Request $request, User $usuario)
    {
        $data = $this->validateUsuario($request, $usuario);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect('/vista/usuarios')->with('successMessage', 'Usuario actualizado correctamente.');
    }

    public function usuarioDestroy(User $usuario)
    {
        $usuario->delete();

        return redirect('/vista/usuarios')->with('successMessage', 'Usuario eliminado correctamente.');
    }

    private function validateCliente(Request $request, ?Cliente $cliente = null): array
    {
        return $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'empresa' => 'nullable|string|max:255',
            'correo' => 'required|email|unique:clientes,correo,'.($cliente?->id ?? 'NULL'),
        ]);
    }

    private function validateSolicitud(Request $request, ?Solicitud $solicitud = null): array
    {
        $rules = [
            'descripcion' => 'required|string',
            'consultoriaId' => 'required|exists:consultorias,id',
        ];

        if ($this->isAdmin()) {
            $rules += [
                'estado' => 'required|in:PENDIENTE,EN_PROCESO,FINALIZADA',
                'fecha' => 'required|date',
                'clienteId' => ($solicitud?->exists ? 'nullable' : 'required').'|exists:clientes,id',
            ];
        } else {
            $rules += [
                'nombreSolicitante' => 'required|string|max:255',
                'correoSolicitante' => 'required|email|max:255',
            ];
        }

        $data = $request->validate($rules);

        if ($this->isAdmin()) {
            $cliente = isset($data['clienteId']) ? Cliente::find($data['clienteId']) : $solicitud?->cliente;

            return [
                'descripcion' => $data['descripcion'],
                'nombre_solicitante' => $cliente?->nombre ?? $solicitud?->nombre_solicitante,
                'correo_solicitante' => $cliente?->correo ?? $solicitud?->correo_solicitante,
                'estado' => $data['estado'],
                'fecha' => $data['fecha'],
                'user_id' => $solicitud?->user_id,
                'cliente_id' => $cliente?->id,
                'consultoria_id' => $data['consultoriaId'],
            ];
        }

        return [
            'descripcion' => $data['descripcion'],
            'nombre_solicitante' => $data['nombreSolicitante'],
            'correo_solicitante' => $data['correoSolicitante'],
            'estado' => $solicitud?->estado ?? 'PENDIENTE',
            'fecha' => $solicitud?->fecha ?? now()->toDateString(),
            'user_id' => Auth::id(),
            'cliente_id' => $solicitud?->cliente_id,
            'consultoria_id' => $data['consultoriaId'],
        ];
    }

    private function validateUsuario(Request $request, ?User $usuario = null): array
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.($usuario?->id ?? 'NULL'),
            'password' => ($usuario?->exists ? 'nullable' : 'required').'|string|min:6',
            'rolId' => 'required|exists:roles,id',
        ]);

        $data['rol_id'] = $data['rolId'];
        unset($data['rolId']);

        return $data;
    }
}
