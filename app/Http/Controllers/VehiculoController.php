<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Importador;
use Barryvdh\DomPDF\Facade\Pdf;
class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('vehiculos.tabla-vehiculos', compact('vehiculos'));
    }

    public function create()
    {
        return view('vehiculos.altavehiculo');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nombre' => 'required|string',
            'tipo' => 'string|nullable',
            'capacidad' => 'numeric',
            'color' => 'string',
            'precio' => 'numeric',
            'estado' => 'integer',
        ]);

        $vehiculo = new Vehiculo([
            'nombre' => $validateData['nombre'],
            'tipo' => $validateData['tipo'],
            'capacidad' => $validateData['capacidad'],
            'color' => $validateData['color'],
            'precio' => $validateData['precio'],
            'estado' => $validateData['estado'],
        ]);
        
        $vehiculo->usuario_id = Auth::id();
        $vehiculo->save();

        return redirect()->route('dashboard')
            ->with('success', 'Vehículo creado exitosamente.');
    }

    public function agregar(Request $request, $id)
    {
        $validateData = $request->validate([
            'imagen_3d' => 'string',
        ]);
    
        $vehiculo = Vehiculo::findOrFail($id);
    
        $vehiculo->imagen_3d = $validateData['imagen_3d'];
        $vehiculo->usuario_id = Auth::id();
        $vehiculo->save();
    
        return redirect()->route('dashboard')->with('success', 'Imagen del vehículo subida exitosamente.');
    }
    
    public function showForm($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
    
        return view('vehiculos.subirImage', compact('vehiculo'));
    }
    

    public function vehiculosbec()
{
    $vehiculos = Vehiculo::all();
    return view('vehiculos.vehiculosbec', compact('vehiculos'));
}
    public function edit($id)
{
    $vehiculo = Vehiculo::findOrFail($id);
    return view('vehiculos.editar', compact('vehiculo'));
}

public function update(Request $request, $id)
{
    $validateData = $request->validate([
        'nombre' => 'required|string',
        'tipo' => 'string|nullable',
        'capacidad' => 'numeric',
        'color' => 'string',
        'precio' => 'numeric',
        'estado' => 'integer',
    ]);

    $vehiculo = Vehiculo::findOrFail($id);
    $vehiculo->update([
        'nombre' => $validateData['nombre'],
        'tipo' => $validateData['tipo'],
        'capacidad' => $validateData['capacidad'],
        'color' => $validateData['color'],
        'precio' => $validateData['precio'],
        'estado' => $validateData['estado'],
    ]);

    return redirect()->route('dashboard')
        ->with('success', 'Vehículo actualizado exitosamente.');
}

public function destroy($id)
{
    $vehiculo = Vehiculo::findOrFail($id);
    $vehiculo->delete();

    return redirect()->route('dashboard')
        ->with('success', 'Vehículo eliminado exitosamente.');
}





    public function showMyVehicles()
    {
        $vehiculos = Vehiculo::where('usuario_id', Auth::id())->get();
        
        return view('vehiculos.ver-vehiculos', compact('vehiculos'));
    }
    public function mostrarFormularioImportar()
    {
        return view('importar');
    }
    public function importar(Request $request)
    {
        $file = $request->file('archivo');

        Excel::import(new Importador, $file);

        return redirect()->back()->with('mensaje', 'Importación completada');
    }


    public function mostrarVehiculos(Request $request)
    {
        // Obtén todos los tipos disponibles
        $tipos = Vehiculo::select('tipo')->distinct()->pluck('tipo');
    
        // Filtra por tipo si se proporciona en la URL
        $tipoSeleccionado = $request->get('tipo');
        $query = ($tipoSeleccionado)
            ? Vehiculo::where('tipo', $tipoSeleccionado)
            : Vehiculo::query();
    
        // Obtén los vehículos ordenados por tipo
        $vehiculos = $query->orderBy('tipo')->get();
    
        // Si se solicita la descarga en formato PDF
        if ($request->has('download')) {
            $pdf = PDF::loadView('vehiculos.vervehiculos', compact('vehiculos'));
            return $pdf->download('vehiculos.pdf');
        }
    
        // Renderiza la vista con los vehículos y tipos disponibles
        return view('vehiculos.vervehiculos', compact('vehiculos', 'tipos', 'tipoSeleccionado'));
    }
    
    public function mostrarComprarVehiculo()
{
    $vehiculos = Vehiculo::all();
    return view('vehiculos.compravehiculo', compact('vehiculos'));
}
    public function comprarVehiculo($id)
{
    $vehiculo = Vehiculo::find($id);
    
    if (!$vehiculo) {
        return redirect()->back()->with('mensaje', 'Vehículo no encontrado');
    }

    $vehiculo->estado = 2;
    $vehiculo->save();

    return redirect()->back()->with('mensaje', 'Vehículo pedido con éxito');
}




public function mostrarConfirmarVehiculo()
{
$vehiculos = Vehiculo::all();
return view('vehiculos.confirmarvehiculo', compact('vehiculos'));
}


public function confirmarvehiculo($id)
{
$vehiculo = Vehiculo::find($id);

if (!$vehiculo) {
    return redirect()->back()->with('mensaje', 'Vehículo no encontrado');
}

$vehiculo->estado = 3;
$vehiculo->save();

return redirect()->back()->with('mensaje', 'Vehículo comprado');
}


}
