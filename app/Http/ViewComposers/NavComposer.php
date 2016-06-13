<?php

namespace App\Http\ViewComposers;

use App\Models\Page;
use Illuminate\View\View;
use Illuminate\Users\Repository as UserRepository;

class NavComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $pages;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $this->pages = Page::where('page_id', '=', 0)
            ->where('hidden', '=', 'N')
            ->where('live', '=', 'Y')
            ->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('pages', $this->pages);
    }
}