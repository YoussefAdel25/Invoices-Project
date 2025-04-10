<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('sections.sections', compact('sections'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
        ], [
            'section_name.required' => 'يرجي ادخال اسم القسم',
            'section_name.unique' => 'اسم القسم مسجل مسبقا',
        ]);

        Section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'Created_by' => Auth::user()->name,
        ]);

        session()->flash('Add', 'تم اضافة القسم بنجاح');
        return redirect('/sections');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'section_name' => 'required|max:255|unique:sections,section_name,' . ($id ?? null),
            'description' => 'required',
        ], [
            'section_name.required' => 'يرجي ادخال اسم القسم',
            'section_name.unique' => 'اسم القسم مسجل مسبقا',
            'description.required' => 'يرجي ادخال البيان',
        ]);

        $section = Section::find($id);
        if ($section) {
            $section->update([
                'section_name' => $request->section_name,
                'description' => $request->description,
            ]);
            session()->flash('edit', 'تم تعديل القسم بنجاح');
        } else {
            session()->flash('error', 'القسم غير موجود');
        }

        return redirect('/sections');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $section = Section::find($id);
        if ($section) {
            $section->delete();
            session()->flash('delete', 'تم حذف القسم بنجاح');
        } else {
            session()->flash('error', 'القسم غير موجود');
        }

        return redirect('/sections');
    }
}
