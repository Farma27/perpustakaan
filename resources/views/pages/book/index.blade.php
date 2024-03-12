@extends('layouts.app')

@section('title', $title)

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary font-weight-bold">{{ $title }}</h1>
                @can('books.create')
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <a href="{{ route('books.create') }}" type="button" class="btn btn-primary">
                            {{ __('buku.title.create') }}
                        </a>
                    </div>
                @endcan
            </div>
            <div class="card">
                <div class="card-body">
                    @php
                        $tableHeaders = [
                            __('buku.form.title'),
                            __('buku.form.isbn.title'),
                            __('buku.form.author'),
                            __('buku.form.category_id'),
                        ];

                        $tableColumn = [
                            ['data' => 'title'],
                            ['data' => 'isbn'],
                            ['data' => 'author'],
                            ['data' => 'category_id'],
                        ];

                        if (Gate::allows('books.edit')) {
                            $tableHeaders[] = 'Aksi';
                            $tableColumn[] = ['data' => 'action'];
                        }
                    @endphp

                    <x-datatable :tableId="'books'" :tableHeaders="$tableHeaders" :tableColumns="$tableColumn" :getDataUrl="route('datatables.books')" />
                </div>
            </div>
        </div>
    </div>
@endsection
