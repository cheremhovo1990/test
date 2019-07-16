@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')
    <form method="POST" action="{{route('admin.adverts.categories.attributes.store')}}">
        @csrf
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control{{$errors->has('name') ? ' is-invalid' : ''}}" name="name"
                   value="{{old('name')}}" required type="text">
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{$errors->first('name')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="sort" class="col-form-label">Sort</label>
            <input id="sort" class="form-control{{$errors->has('sort') ? ' is-invalid' : ''}}" name="sort"
                   value="{{old('sort')}}" required type="text">
            @if ($errors->has('sort'))
                <span class="invalid-feedback"><strong>{{$errors->first('sort')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="type" class="col-form-label">Type</label>
            <select name="type" id="type" class="form-control{{$errors->has('type') ? ' is-invalid' : ''}}">
                @foreach($types as $type => $label)
                    <option value="{{$type}}" {{$type == old('type') ? ' selected' : ''}}>{{$label}}</option>
                @endforeach
            </select>
            @if ($errors->has('type'))
                <span class="invalid-feedback"><strong>{{$errors->first('type')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="variants" class="col-form-label">Variants</label>
            <textarea name="variants" id="variants"
                      class="form-control{{$errors->has('variants') ? ' is-invalid' : ''}}">{{old('variants')}}</textarea>
            @if ($errors->has('variants'))
                <span class="invalid-feedback"><strong>{{$errors->first('variants')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <input type="hidden" name="required" value="0">
            <div class="checkbox">
                <label for="">
                    <input type="checkbox" name="required" {{old('required') ? 'checked': ''}}> Required
                </label>
            </div>
            @if ($errors->has('required'))
                <span class="invalid-feedback"><strong>{{$errors->first('required')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection