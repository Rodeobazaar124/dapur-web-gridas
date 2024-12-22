<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResponse;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    /**
     * Display a listing of the majors.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $majors = Major::latest()->paginate(5);
        return new DefaultResponse(true, 'List Data majors', $majors);
    }

    /**
     * Store a newly created major in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'     => 'required|string',
            'slug'   => 'required|string',
            'excerpt'   => 'required|string',
            'insight'   => 'nullable|string',
            'career'   => 'nullable|string',
            'curriculum'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        unset($validator);
        $image = $request->file('image');
        $image->storeAs('public/majors', $image->hashName());

        $major = Major::create([
            'logo'     => $image->hashName(),
            'name'     => $request->name,
            'slug'   => $request->slug,
            'excerpt'   => $request->excerpt,
            'insight'   => $request->insight,
            'career'   => $request->career,
            'curriculum'   => $request->curriculum
        ]);

        return new DefaultResponse(true, 'Jurusan Baru Berhasil Ditambahkan!', $major);
    }

    /**
     * Display the specified major.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $major = Major::find($id);
        return new DefaultResponse(true, 'Detail Data Jurusan.', $major);
    }

    /**
     * Update the specified major in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'logo'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'     => 'required|string',
            'slug'     => 'required|string',
            'excerpt'  => 'required|string',
            'insight'  => 'nullable|string',
            'career'   => 'nullable|string',
            'curriculum' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $major = Major::find($id);

        if ($request->hasFile('logo')) {
            Storage::delete('public/majors/' . basename($major->logo));
            $image = $request->file('logo');
            $image->storeAs('public/majors', $image->hashName());
            $major->logo = $image->hashName();
        }

        $major->name = $request->name;
        $major->slug = $request->slug;
        $major->excerpt = $request->excerpt;
        $major->insight = $request->insight;
        $major->career = $request->career;
        $major->curriculum = $request->curriculum;
        $major->save();

        return new DefaultResponse(true, 'Jurusan Berhasil Diubah!', $major);
    }

    /**
     * Remove the specified major from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $major = Major::find($id);
        Storage::delete('public/majors/' . basename($major->image));
        $major->delete();
        return new DefaultResponse(true, 'Jurusan Berhasil Dihapus!', null);
    }
}
