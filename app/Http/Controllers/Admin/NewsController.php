<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Services\OpenAITranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    protected $translator;

    public function __construct(OpenAITranslationService $translator)
    {
        $this->translator = $translator;
    }

    public function index()
    {
        $news = News::where('site_id', '1')
                    ->orderBy('published_at', 'desc')
                    ->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_es' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'slug_es' => 'required|string|max:255|unique:news',
            'slug_en' => 'required|string|max:255|unique:news',
            'excerpt_es' => 'required|string',
            'excerpt_en' => 'required|string',
            'content_es' => 'required|string',
            'content_en' => 'required|string',
            'publication_status' => 'required|in:draft,publish_now,schedule',
            'published_at' => 'required_if:publication_status,schedule|nullable|date'
        ]);

        $news = new News();
        $news->site_id = '1'; // Temporal hasta implementar multisite
        $news->slug = json_encode([
            'es' => $validated['slug_es'],
            'en' => $validated['slug_en']
        ]);
        $news->title = json_encode([
            'es' => $validated['title_es'],
            'en' => $validated['title_en']
        ]);
        $news->excerpt = json_encode([
            'es' => $validated['excerpt_es'],
            'en' => $validated['excerpt_en']
        ]);
        $news->content = json_encode([
            'es' => $validated['content_es'],
            'en' => $validated['content_en']
        ]);

        // Manejar el estado de publicación
        switch ($validated['publication_status']) {
            case 'publish_now':
                $news->is_published = true;
                $news->published_at = now();
                break;
            
            case 'schedule':
                $news->is_published = true;
                $news->published_at = new \DateTime($validated['published_at']);
                break;
            
            default: // draft
                $news->is_published = false;
                $news->published_at = null;
                break;
        }

        $news->save();

        return redirect()->route('admin.news.index')
            ->with('success', __('News created successfully'));
    }

    public function edit(News $news)
    {
        // Decode JSON fields
        $title = json_decode($news->title, true);
        $content = json_decode($news->content, true);
        $excerpt = json_decode($news->excerpt, true);

        return view('admin.news.edit', compact('news', 'title', 'content', 'excerpt'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title_es' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_es' => 'required|string',
            'content_en' => 'required|string',
            'excerpt_es' => 'required|string',
            'excerpt_en' => 'required|string',
            'slug_es' => 'required|string|unique:news,slug,' . $news->id,
            'slug_en' => 'required|string|unique:news,slug,' . $news->id,
            'is_published' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $news->title = json_encode([
            'es' => $validated['title_es'],
            'en' => $validated['title_en']
        ]);
        $news->content = json_encode([
            'es' => $validated['content_es'],
            'en' => $validated['content_en']
        ]);
        $news->excerpt = json_encode([
            'es' => $validated['excerpt_es'],
            'en' => $validated['excerpt_en']
        ]);
        $news->slug = json_encode([
            'es' => $validated['slug_es'],
            'en' => $validated['slug_en']
        ]);
        $news->is_published = $validated['is_published'] ?? false;
        $news->published_at = $validated['published_at'] ?? now();
        $news->save();

        return redirect()->route('admin.news.index')
            ->with('success', __('News updated successfully'));
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', __('News deleted successfully'));
    }

    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'type' => 'required|in:title,excerpt,content'
        ]);

        $translated = $this->translator->translate($request->text);

        return response()->json([
            'success' => !empty($translated),
            'translation' => $translated
        ]);
    }
}
