<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use App\Models\GaleriaFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    public function uploadFotos(Request $request, Galeria $galeria)
    {
        $request->validate(['fotos.*' => 'image|max:4096']);
        foreach ($request->file('fotos', []) as $foto) {
            $path = $foto->store('galeria/' . $galeria->id, 'public');
            $galeria->fotos()->create([
                'arquivo' => $path,
                'ordem'   => $galeria->fotos()->count(),
            ]);
        }
        return back()->with('success', 'Fotos enviadas!');
    }

    public function destroyFoto(GaleriaFoto $foto)
    {
        Storage::disk('public')->delete($foto->arquivo);
        $foto->delete();
        return back()->with('success', 'Foto removida!');
    }
}
