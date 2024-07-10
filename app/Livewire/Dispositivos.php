<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dispositivo;

class Dispositivos extends Component
{
    use WithPagination;

    public $search = '';
    public $ubicacion, $categoria, $encargado, $marca, $modelo, $numero_serie, $id_dispositivo;
    public $modal = false;
    protected $dispositivos; 

    public function render()
    {
        $this->dispositivos = Dispositivo::where('ubicacion', 'like', '%'.$this->search.'%')
            ->orWhere('categoria', 'like', '%'.$this->search.'%')
            ->orWhere('encargado', 'like', '%'.$this->search.'%')
            ->orWhere('marca', 'like', '%'.$this->search.'%')
            ->orWhere('modelo', 'like', '%'.$this->search.'%')
            ->orWhere('numero_serie', 'like', '%'.$this->search.'%')
            ->paginate(10);

        return view('livewire.dispositivos', [
            'dispositivos' => $this->dispositivos, 
        ])->layout('layouts.app');
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->abrirModal();
    }

    public function abrirModal() {
        $this->modal = true;
    }

    public function cerrarModal() {
        $this->modal = false;
    }

    public function limpiarCampos(){
        $this->ubicacion = '';
        $this->categoria = '';
        $this->encargado = '';
        $this->marca = '';
        $this->modelo = '';
        $this->numero_serie = '';
        $this->id_dispositivo = '';
    }

    public function editar($id)
    {
        $dispositivo = Dispositivo::findOrFail($id);
        $this->id_dispositivo = $id;
        $this->ubicacion = $dispositivo->ubicacion;
        $this->categoria = $dispositivo->categoria;
        $this->encargado = $dispositivo->encargado;
        $this->marca = $dispositivo->marca;
        $this->modelo = $dispositivo->modelo;
        $this->numero_serie = $dispositivo->numero_serie;
        $this->abrirModal();
    }

    public function borrar($id)
    {
        Dispositivo::find($id)->delete();
        session()->flash('message', 'Registro eliminado correctamente');
    }

    public function guardar()
    {
        Dispositivo::updateOrCreate(['id' => $this->id_dispositivo], [
            'ubicacion' => $this->ubicacion,
            'categoria' => $this->categoria,
            'encargado' => $this->encargado,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'numero_serie' => $this->numero_serie,
        ]);

        session()->flash('message', 
            $this->id_dispositivo ? '¡Actualización exitosa!' : '¡Alta Exitosa!');

        $this->cerrarModal();
        $this->limpiarCampos();
    }
}