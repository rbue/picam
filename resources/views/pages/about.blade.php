@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Über diese Applikation</div>

                    <div class="panel-body">
                        <h1>Autor</h1>
                        <p>Erstellt von <a href="mailto:robinbuerkli@bluewin.ch">Robin Bürkli</a> im Rahmen des Modul 152 der Gewerblich-industriellen Berufsfachschule Muttenz.</p>
                        <h1>Bibliotheken / Frameworks</h1>
                        <p>Die folgenden Frameworks und Bibliotheken wurden innerhalb dieses Projekts verwendet:
                            <ul>
                                <li><a href="http://laravel.com/" target="_blank">Laravel 5</a></li>
                                <li><a href="http://getbootstrap.com/" target="_blank">Bootstrap 3</a></li>
                                <li><a href="https://jquery.com/" target="_blank">jQuery</a></li>
                                <li><a href="http://datatables.net/" target="_blank">jQuery DataTables</a></li>
                                <li><a href="http://notifyjs.com/" target="_blank">NotifyJs</a></li>
                            </ul>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Informationen')