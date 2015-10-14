@extends('gestor.gestor')
@section('content')

<div class="page-title">

    <div class="title-env">
        <h1 class="title">Documentos e informes</h1>

    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="{{{url('gestor')}}}"><i class="fa-home"></i>Gestor</a>
            </li>

            <li class="active">

                <strong>Documentos e informes</strong>
            </li>

        </ol>

    </div>

</div>
<ul class="nav nav-tabs">
    <li class="active">
        <a href="#xmlSepe" data-toggle="tab">
            <span class="visible-md"><i class="fa-home"></i></span>
            <span class="hidden-md">XML's SEPE</span> </a>
    </li>

    <li>
        <a href="#formacion-complementaria" data-toggle="tab">
            <span class="visible-md"><i class="fa-home"></i></span>
            <span class="hidden-md">Formación complementaria</span> </a>
    </li>



</ul>

<div class="tab-content">
    @include("documentos.tab-xml-sepe")
</div>
@endsection