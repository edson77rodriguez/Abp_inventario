@extends('dashboard')

@section('template_title')
    {{ __('Create') }} Origene
@endsection

@section('crud_content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Origene</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('origenes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('origene.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
