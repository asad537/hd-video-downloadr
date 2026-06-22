<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function loginForm() { return view('admin.login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required']]);
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Email or password is incorrect.'])->onlyInput('email');
        }
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {
        return view('admin.dashboard', [
            'posts' => BlogPost::latest('updated_at')->get(),
            'editing' => $request->filled('edit') ? BlogPost::findOrFail((int) $request->query('edit')) : null,
            'settings' => SiteSetting::values(),
        ]);
    }

    public function savePost(Request $request, BlogPost $post = null)
    {
        $post = $post ?: new BlogPost();
        $data = $request->validate([
            'title' => ['required', 'max:180'], 'slug' => ['nullable', 'max:180'], 'category' => ['nullable', 'max:80'],
            'excerpt' => ['required', 'max:500'], 'meta_title' => ['nullable', 'max:180'], 'meta_description' => ['nullable', 'max:320'],
            'content' => ['required'], 'image' => ['nullable', 'image', 'max:5120'], 'image_alt' => ['nullable', 'max:180'],
            'read_minutes' => ['required', 'integer', 'min:1', 'max:60'], 'is_published' => ['nullable', 'boolean'],
        ]);

        $baseSlug = Str::slug($data['slug'] ?: $data['title']);
        $slug = $baseSlug;
        $number = 2;
        while (BlogPost::where('slug', $slug)->when($post->exists, function ($query) use ($post) { $query->where('id', '!=', $post->id); })->exists()) {
            $slug = $baseSlug . '-' . $number++;
        }

        if ($request->hasFile('image')) {
            if ($post->image && Str::startsWith($post->image, '/storage/')) Storage::disk('public')->delete(Str::after($post->image, '/storage/'));
            $data['image'] = '/storage/' . $request->file('image')->store('blog', 'public');
        } else {
            unset($data['image']);
        }
        $data['slug'] = $slug;
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? ($post->published_at ?: now()) : null;
        $post->fill($data)->save();

        return redirect()->route('admin.dashboard')->with('status', 'Post saved successfully.');
    }

    public function deletePost(BlogPost $post)
    {
        if ($post->image && Str::startsWith($post->image, '/storage/')) Storage::disk('public')->delete(Str::after($post->image, '/storage/'));
        $post->delete();
        return back()->with('status', 'Post deleted.');
    }

    public function saveSettings(Request $request)
    {
        $data = $request->validate([
            'site_name' => ['required', 'max:80'], 'hero_title' => ['required', 'max:120'],
            'hero_subtitle' => ['required', 'max:300'], 'default_meta_description' => ['required', 'max:320'],
        ]);
        foreach ($data as $key => $value) SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        return back()->with('status', 'Site settings updated.');
    }
}
