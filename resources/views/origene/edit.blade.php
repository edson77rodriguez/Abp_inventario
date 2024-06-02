@extends('dashboard')

@section('template_title')
    {{ __('Update') }} Origene
@endsection

@section('crud_content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Origene</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('origenes.update', $origene->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('origene.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
