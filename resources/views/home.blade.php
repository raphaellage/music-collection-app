@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>{{ __('Music Collections') }}</div>
                        <a class="btn btn-primary btn-sm" href="{{ route('album.create') }}">add</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($albums->count() > 0)
                    <table class="table table-hover table-reponsive">
                        <thead>
                            <tr>
                                <th scope="col">Album</th>
                                <th scope="col">Artist</th>
                                <th scope="col">Year</th>
                                <th class="text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    @endif
                        @forelse ($albums as $album)
                            <tr>
                                <td scope="row">{{ $album->name }}</td>
                                @foreach ($artists as $artist)
                                    @if ($artist[0]['id'] === $album->artist)
                                        <td>{{ $artist[0]['name'] }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $album->year }}</td>
                                <td>
                                    <div class="d-flex justify-content-end gap-4">
                                        <a href="{{ route('album.show', $album->id) }}" class="btn btn-outline-primary btn-sm ml-2">show</a>
                                    @can('edit albums')
                                        <a href="{{ route('album.edit', $album->id) }}" class="btn btn-outline-secondary btn-sm ml-2">edit</a>
                                    @endcan
                                    @can('delete albums')
                                        <form method="POST" action="{{ route('album.delete', $album->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="d-flex btn btn-outline-danger btn-sm ml-2">Delete</button>
                                        </form>
                                    @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="d-flex justify-content-center">
                                <h2>No collections found...</h2>
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
