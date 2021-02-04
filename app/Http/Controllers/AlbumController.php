<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ArtistApiRepository;
use App\Repositories\AlbumRepository;

class AlbumController extends Controller
{
    protected $albumRepository;

    // Construct
    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    // Create method
    public function create()
    {
        $this->middleware('permission:create albums');
        return view('pages.album.create')->with(['artists' => ArtistApiRepository::all()]);
    }

    // Store methods
    public function store(Request $request)
    {
        $this->middleware('permission:create albums');

        $artists = ArtistApiRepository::all();

        $artists_ids = [];
        foreach($artists as $artist)
        {
            $artists_ids[] = $artist[0]['id'];
        }

        // I choose to do this validation here becouse there are few fields
        $request->validate([
            'artist' => 'required|string|in:' . implode(',', $artists_ids),
            'name' => 'required|string',
            'year' => 'required|digits:4'
        ]);

        $this->albumRepository->create($request->input());

        return redirect()->route('home')->withSuccess('New album added succesfully!');
    }

    // Show method
    public function show($album)
    {
        $this->middleware('auth');
        $album = $this->albumRepository->find($album);

        // The result of searching artist seens wrong,
        // cuz it return a collection
        $artists = ArtistApiRepository::find($album->artist);

        $artist_info = [];

        foreach($artists as $artist)
        {
            if($album->artist === $artist[0]['id'])
            {
                $artist_info['name'] = $artist[0]['name'];
                $artist_info['twitter'] = $artist[0]['twitter'];
            }
        }

        return view('pages.album.show')->with(['album' => $album, 'artist' => $artist_info]);
    }

    // Edit method
    public function edit($album)
    {
        $this->middleware('permission:edit albums');

        $album = $this->albumRepository->find($album);
        $artists = ArtistApiRepository::all();
        return view('pages.album.edit', compact('album', 'artists'));
    }

    // Update method
    public function update(Request $request, $album)
    {
        $this->middleware('permission:create albums');

        $artists = ArtistApiRepository::all();

        $artists_ids = [];
        foreach ($artists as $artist) {
            $artists_ids[] = $artist[0]['id'];
        }

        // I choose to do this validation here becouse there are few fields
        $request->validate([
            'artist' => 'required|string|in:' . implode(',', $artists_ids),
            'name' => 'required|string',
            'year' => 'required|digits:4'
        ]);

        $this->albumRepository->update($request->input(), $album);

        return redirect()->route('home')->withSuccess('New album added succesfully!');
    }

    public function delete($album)
    {
        $this->middleware('permission:delete albums');
        $this->albumRepository->delete($album);
        return redirect()->route('home');
    }
}
