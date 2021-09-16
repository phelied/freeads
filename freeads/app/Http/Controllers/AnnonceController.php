<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnonceController extends Controller
{

    public function showIndex()
    {
        $userId = Auth::id();
        $annonces = DB::select('select * from annonces where id_user= ?', [$userId]);
        for ($i = 0; $i < count($annonces); $i++) {
            $annonces[$i]->pictures = explode("|", $annonces[$i]->pictures);
        }
        return view("welcome", ['annonces' => $annonces]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annonces = DB::select('select * from annonces');
        for ($i = 0; $i < count($annonces); $i++) {
            $annonces[$i]->pictures = explode("|", $annonces[$i]->pictures);
        }
        return view('annonce.annonces', ['annonces' => $annonces]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("annonce.createAnnonce");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $annonce = new Annonce;
        $userId = Auth::id();
        $pictures = array();
        if (!$request->pictures) {
            $annonce->pictures = "/storage/uploads/1631624119_avatar.png";
        } else {
            $files = $request->pictures;
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $fileName = time() . '_' . $name;
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $name = '/storage/' . $filePath;
                $pictures[] = $name;
            }
            $annonce->pictures = implode("|", $pictures);
        }
        $annonce->fill(['title' => $request->title, "description" => $request->description, "price" => $request->price, "id_user" => $userId],);
        $annonce->save();
        return back()
            ->with('success', 'Votre annonce à bien été créé.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        $annonces = DB::select('select * from annonces where id= ?', [$annonce["id"]]);
        for ($i = 0; $i < count($annonces); $i++) {
            $annonces[$i]->pictures = explode("|", $annonces[$i]->pictures);
        }
        return view('annonce.updateAnnonce', ['annonces' => $annonces]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        $userId = Auth::id();

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:225|',
            'price' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $files = $request->pictures;
        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $fileName = time() . '_' . $name;
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $name = '/storage/' . $filePath;
            $pictures[] = $name;
        }
        $annonce->pictures = implode("|", $pictures);

        $annonce->fill([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'id_user' => $userId,
        ]);

        $annonce->save();
        return back()
            ->with('success', 'Votre annonce à bien été modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        $deleted = DB::delete('delete from annonces where id= ?', [$annonce["id"]]);
        return redirect('/home')->with('status', 'Votre annonce à bien été supprimée.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */

    public function preview(Annonce $annonce)
    {
        $annonces = DB::select('select * from annonces where id= ?', [$annonce["id"]]);
        for ($i = 0; $i < count($annonces); $i++) {
            $annonces[$i]->pictures = explode("|", $annonces[$i]->pictures);
        }
        return view('annonce.preview-delete', ['annonces' => $annonces]);
    }
}
