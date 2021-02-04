@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div><a class="btn btn-outline-secondary btn-sm mr-2" href="{{ route('home') }}">{{ __('Back') }}</a>{{ __('To Music Collections') }}</div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table table-hover table-reponsive">
                        <tbody>
                            <tr>
                                <td>Album name</td>
                                <td>{{ $album->name }}</td>
                            </tr>
                            <tr>
                                <td>Year</td>
                                <td>{{ $album->year }}</td>
                            </tr>
                            <tr>
                                <td>Artist name</td>
                                <td>{{ $artist['name'] }}</td>
                            </tr>
                            <tr>
                                <td>Twitter account</td>
                                <td>{{ $artist['twitter'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
