@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{Session::get('error')}}
                        </div>
                    @endif
                    <div class="table-wrapper">
                        <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('search') }}">
                            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Szukaj">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Szukaj') }}
                            </button>
                        </form>
                        <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('choice') }}">
                        <table class="fl-table">
                        
                        <tr>
                           <td></td>
                           <td>Imię</td> 
                           <td>Nazwisko</td> 
                           <td>Adres</td> 
                           <td>Telefon</td> 
                           <td>Email</td>
                        </tr>
                        
                        @foreach ($contacts as $contact)
                        <tr>
                            <td><input type="radio" name="choice" value={{ $contact->id }}></td>
                            <td>{{ $contact->name }}</td> 
                            <td>{{ $contact->surname }}</td> 
                            <td>{{ $contact->address }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        @endforeach
                        </table>
                        <input class="btn btn-primary" type="submit" name="edit" value="{{ __('Edytuj') }}">
                        <input class="btn btn-primary" type="submit" name="delete" value="{{ __('Usuń') }}">
                        </form>
                        <h2>Dodaj nowy kontakt</h2>
                        <form method="GET" action="{{ route('addContact') }}">
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Imię') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Nazwisko') }}</label>
    
                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname">
                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Adres') }}</label>
    
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Telefon') }}</label>
    
                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Dodaj') }}
                                    </button><br><br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
