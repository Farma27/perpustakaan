@extends('layouts.app')

@section('title', $title)

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary font-weight-bold">{{ $title }}</h1>
                @can('categories.create')
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <a href="{{ route('categories.create') }}" type="button" class="btn btn-primary">
                            {{ __('kategori.title.create') }}
                        </a>
                    </div>
                @endcan
            </div>
            <div class="card">
                <div class="card-body">
                    <x-datatable :tableId="'categories'" :tableHeaders="[__('kategori.form.category_name'), 'Aksi']" :tableColumns="[['data' => 'category_name'], ['data' => 'action']]" :getDataUrl="route('datatables.categories')" />
                </div>
            </div>
        </div>
    </div>
@endsection