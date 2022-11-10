@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
@stop

@section('content')
<style>
    .has-error{
        border-color: #f55145 !important;
    }
</style>
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
              method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                    {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control @if ($errors->has('first_name')) has-error @endif" id="first_name" name="first_name" placeholder="First Name"
                                       value="{{ old('first_name', $dataTypeContent->first_name ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control @if ($errors->has('last_name')) has-error @endif" id="last_name" name="last_name" placeholder="Last Name"
                                       value="{{ old('last_name', $dataTypeContent->last_name ?? '') }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="locale">Gender</label>
                                <select class="form-control select2" id="gender" name="gender">                                    
                                    <option value="male" <?=($dataTypeContent->gender=='male')?'selected':''?>>Male</option>                                    
                                    <option value="female" <?=($dataTypeContent->gender=='female')?'selected':''?>>Female</option>                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control @if ($errors->has('age')) has-error @endif" id="age" name="age" placeholder="Age"
                                       value="{{ old('age', $dataTypeContent->age ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="joined_date">Joined Date</label>
                                <input type="date" class="form-control @if ($errors->has('joined_date')) has-error @endif" id="joined_date" name="joined_date" placeholder="Joined Date"
                                       value="{{ old('joined_date', $dataTypeContent->joined_date ?? '') }}">
                            </div>
                            <!-- <div class="form-group">
                                <label for="email">{{ __('voyager::generic.email') }}</label>
                                <input type="email" class="form-control @if ($errors->has('email')) has-error @endif" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}"
                                       value="{{ old('email', $dataTypeContent->email ?? '') }}">
                            </div>                                                         -->
                        </div>
                    </div>
                </div>                
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                {{ __('voyager::generic.save') }}
            </button>
        </form>
        <div style="display:none">
            <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
            <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
