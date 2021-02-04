<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AlbumRepository;
use App\Repositories\ArtistApiRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $albumRepository;

    public function __construct(AlbumRepository $albumRepository)
    {
        $this->middleware('auth');
        $this->albumRepository = $albumRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with([
            'albums' => $this->albumRepository->all(),
            'artists' => ArtistApiRepository::all()
        ]);
    }
}
