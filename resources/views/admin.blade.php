@extends('layouts.app')

@section('content')
<div class="wrapper">
    {{-- Page Content --}}
    <ul id="content" class="container mt-5">
        <h1> Bonjour {{ Auth::user()->name }} !</h1>
        <div class="admin-accueil">
            <ul>
                <li>
                    <p><span>Gestion des utilisateurs :</span> Ajoutez des utilisateurs de tous les types, Administrateurs, Enseignants et &Eacute;tudiants à votre convenance. Visualisez &eacute;galemdent la liste de tous les utilisateurs existants.</p>
                </li>
                <li>
                    <p><span>Gestion des unit&eacute;s d'enseignement :</span> Ajoutez des unit&eacute;s d'enseignement et visualisez la liste de celles existantes.</p>
                </li>
                <li>
                    <p><span>Gestion des groupes d'alternants :</span> Créez ou supprimez des groupes d'alternants. Modifiez également leurs membres.</p>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection