<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate();

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        DB::beginTransaction();
        try {

            if ($tag = Tag::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'created_at' => Carbon::now(),
            ])) {
                Db::commit();
                return redirect()->route('admin.tags.index')->with('success', 'Tag Created Successfully');
            }
            Db::rollback();
            return redirect()->back()->with('error', 'Tag was not created!');
        }catch (\Exception $exception){
            Db::rollback();
            return redirect()->back()->with('error', 'An Error Has Occurred!');
        }
    }

    public function destroy($id){
        $tag = Tag::findOrFail($id);

        if ($tag->delete()){
            return redirect()->back()->with('success', 'Deleted Successfully');
        };

        return redirect()->back()->with('error', 'Error!!!Failed');
    }
}
