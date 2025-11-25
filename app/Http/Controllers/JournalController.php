<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJournalRequest;
use App\Models\Article;
use App\Models\Journal;
use App\Services\XmlGeneratorService;
use DOMDocument;
use DOMElement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JournalController extends Controller
{
    public function __construct(
        protected readonly XmlGeneratorService $xmlGenerator
    )
    {}

    public function create(): View
    {
        return view('journal.create');
    }

    public function store(StoreJournalRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $journal = Journal::create($validated);
        return redirect()->route('article.create', ['journal' => $journal]);
    }

    public function xml(Journal $journal)
    {
        $article = Article::findOrFail(1);
        dd($this->xmlGenerator->generateXML($journal, $article));
    }


}
