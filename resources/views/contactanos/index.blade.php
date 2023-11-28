@extends('layouts.plantilla')

@section('title', 'Home')
    
@section('content')
    <h1>Dejanos un mensaje</h1>

    <form action="{{route('contactanos.store')}}" method="POST">
        @csrf
        
        <label>
            Nombre:
            <br>
            <input type="text" name="name">
        </label>
        @error('name')
            <p><strong>{{$message}}</strong></p>
        @enderror
    
        <br>
        <label>
            Correo:
            <br>
            <input type="email" name="correo">
        </label>
        @error('correo')
            <p><strong>{{$message}}</strong></p>
        @enderror
    
        <br>
        <label>
            Mensaje:
            <br>
            <textarea name="mensaje" id="" cols="30" rows="10"></textarea>
        </label>
        @error('mensaje')
            <p><strong>{{$message}}</strong></p>
        @enderror

        <br>
        <button type="submit">Enviar</button>
    </form>

    @if (session('info'))
        <script>
            alert("{{session('info')}}");
        </script>
    @endif

@endsection
