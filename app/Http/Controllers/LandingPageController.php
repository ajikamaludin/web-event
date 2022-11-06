<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return inertia('Page/Index', ['contents' => Content::all()]);
    }

    public function update(Request $request, Content $content)
    {
        if(in_array($content->type, [Content::TYPE_TEXT, Content::TYPE_URL])) {
            $request->validate([
                'content' => 'required|string'
            ]);

            $content->update(['content' => $request->content]);

            return redirect()->route('contents.index')
                ->with('message', ['type' => 'success', 'message' => 'The data has beed saved']);
        }

        if(in_array($content->type, [Content::TYPE_IMAGE])) {
            $request->validate([
                'image' => 'required|image'
            ]);

            $file = $request->file('image');
            $file->store('images', 'public');

            $content->update(['content' => 'images/'.$file->hashName()]);

            return redirect()->route('contents.index')
                ->with('message', ['type' => 'success', 'message' => 'The data has beed saved']);
        }

        return redirect()->route('dashboard')
            ->with('message', ['type' => 'error', 'message' => 'Something went wrong']);
    }
}
