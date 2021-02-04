@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>{{ __('Edit Album') }}</div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('album.update', $album->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="artist" class="col-md-4 col-form-label text-md-right">{{ __('artist') }}</label>

                            <div class="col-md-6">
                                <select id="artist" type="artist"
                                    class="form-control @error('artist') is-invalid @enderror" name="artist" required>
                                    @forelse ($artists as $artist)
                                    <option {{ $album->artist === $artist[0]['id'] ? 'selected' : ''}} value="{{ $artist[0]['id'] }}">{{ $artist[0]['name'] }}</option>
                                    @empty
                                    <option>No options available</option>
                                    @endforelse
                                </select>
                                @error('artist')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Album name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $album->name ?? old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('year') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="number" class="form-control @error('year') is-invalid @enderror"
                                    name="year" min="1800" step="1" max="9999" value="{{ $album->year ?? old('year') }}" required
                                    autocomplete="year">

                                @error('year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
