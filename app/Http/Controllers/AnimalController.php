<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;

class AnimalController extends Controller
{
    /* method listAnimal digunakan untuk memberikan daftar data hewan */
    public function listAnimal()
    {
        $animals = Animal::where('is_delete', '=', 0)->orderBy('name')->paginate(5);
        Paginator::useBootstrap();
        return view('animals.list', compact('animals'));
    }

    /* method newAnimal digunakan untuk memberikan view terhadap tambah.blade.php */
    public function newAnimal()
    {
        return view('animals.tambah');
    }

    /* method saveNewAnimal digunakan untuk menyimpan penambahan data hewan disertai dengan validasi */
    public function saveNewAnimal(Request $request)
    {
        $animal = new Animal;
        $animal->name = $request->input('name');
        $animal->number_of_foot = $request->input('number_of_foot');
        $animal->suara = $request->input('suara');
        $animal->description = $request->input('description');

        /* validasi input */
        $request->validate([
            'name' => ['required', 'max:255'],
            'image' => ['image', 'nullable', 'max:255'],
            'number_of_foot' => ['required'],
            'suara' => ['required'],
            'description' => ['required']
        ]);


        /* validasi input gambar */
        if ($request->hasFile('image')) {
            $imagefile = $request->file('image');
            /* concatinate */
            $animal->image = $imagefile->getClientOriginalName();
            $imagefile->move('public/storage/images', $imagefile->getCLientOriginalName());
        } else {
            $imagefile = 'noimage.jpg';
        }

        /* simpan smeua penambahan data */
        $animal->save();
        /* return redirect('/tambah')->with('status', 'Data Hewan Telah Ditambahkan'); */
        return redirect()->route('daftar-hewan')->with('status', 'Data Hewan Telah Ditambahkan');
    }

    /* method deleteAnimal digunakan untuk melakukan penghapusan data tanpa menghapus pada database atau disebut dengan softdelete */
    public function deleteAnimal($id)
    {
        $animal = Animal::find($id);
        $animal->is_delete = 1;
        $animal->save();
        return redirect()->route('daftar-hewan')->with('status', 'Data Hewan Berhasil Dihapus');
    }

    /* method detailAnimal digunakan untuk memberikan detail dari hewan-hewan yang terdaftar */
    public function detailAnimal($id)
    {
        $animal = Animal::find($id);
        return view('animals.detail', compact('animal'));
    }

    /* method editAnimal digunakan untuk melakukan pemberian formdata terhadap view edit.blade.php */
    public function editAnimal($id)
    {
        $animal = Animal::find($id);
        $formdata = [
            'name' => ['text', "Nama Hewan"],
            'image' => ['file',  "Foto Hewan"],
            /* 'umur' => ['text', "Umur"], */
            'numberoffoot' => ["radio", "Jumlah Kaki Hewan", [2, 4, 6, 8]],
            'suara' => ['text', "Suara", ["Meow", "Mengonggong", "Mengaung"]],
            'description' => ['text', "Deskripsi"]
        ];
        return view('animals.edit', compact('animal', 'formdata'));
    }

    /* method saveEdit untuk menyimpan data yang telah disunting */
    public function saveEdit(Request $request, $id)
    {

        /* $request->view(); */
        $animal = Animal::find($id);

        $animal->name = $request->input('name');
        $animal->image = $request->input('image');
        $animal->number_of_foot = $request->input('numberoffoot');
        $animal->suara = $request->input('suara');
        $animal->description = $request->input('description');

        if ($request->hasFile('image')) {

            $folder = 'public/storage/images/' . $animal->image;

            if (File::exists($folder)) {
                File::delete($folder);
            }

            $imagefile = $request->file('image');
            /* concatinate */
            $animal->image = $imagefile->getClientOriginalName();
            $imagefile->move('public/storage/images', $imagefile->getCLientOriginalName());
        }
        /* } else { */
        /*     $imagefile = 'noimage.jpg'; */
        /* } */

        $animal->update();

        return redirect()->route('daftar-hewan')->with('status', 'Data Hewan Berhasil Disunting');
    }
}
