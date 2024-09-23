<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminTagController extends Controller
{
    public function index(Request $request): View
    {
        $query = Tag::query();
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $viewData = [];
        $viewData['title'] = 'Admin - Tags - Zuca Store';
        $viewData['subtitle'] = 'List of tags';
        $viewData['tags'] = $query->get();
        $viewData['search'] = $request->search;
        
        return view('admin.tag.index')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:tags|max:255',
        ]);

        $newTag = new Tag();
        $newTag->setName($request->input('name'));
        $newTag->save();

        return back()->with('success', 'Tag created successfully');
    }

    public function edit($id): View
    {
        $viewData = [];
        $viewData['title'] = 'Admin - Edit Tag - Zuca Store';
        $viewData['tag'] = Tag::findOrFail($id);
        return view('admin.tag.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:tags,name,'.$id.'|max:255',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->setName($request->input('name'));
        $tag->save();

        return redirect()->route('admin.tag.index')->with('success', 'Tag updated successfully');
    }

    public function delete($id): RedirectResponse
    {
        Tag::destroy($id);
        return back()->with('success', 'Tag deleted successfully');
    }

    public function show(string $id): View|RedirectResponse
    {
        $viewData = [];
        try {
            $tag = Tag::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.tag.index');
        }
        $viewData['title'] = $tag->getName().' - Zuca Store';
        $viewData['subtitle'] = $tag->getName().' - Tag information';
        $viewData['tag'] = $tag;
        return view('admin.tag.show')->with('viewData', $viewData);
    }

    public function search(Request $request): View
    {
        $query = $request->input('query');
        $tags = Tag::where('name', 'LIKE', "%{$query}%")->get();
        $viewData = [];
        $viewData["title"] = "Admin - Search Results";
        $viewData["subtitle"] = "Tags matching: " . $query;
        $viewData["tags"] = $tags;
        return view('admin.tag.index')->with("viewData", $viewData);
    }
}