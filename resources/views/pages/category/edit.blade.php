@extends('layouts.app')

@section('title', $title)

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary font-weight-bold">{{ $title }}</h1>
                <a href="{{ route('categories.index') }}" class="d-none d-sm-inline-block btn btn-outline-primary shadow-sm">
                    Back
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->getKey()) }}" method="post">
                        @csrf @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{__('kategori.form.category_name')}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                    name="category_name" id="category_name" value="{{ old('category_name', $category->category_name) }}" placeholder="{{__('kategori.form.category_name')}}">
                                @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection