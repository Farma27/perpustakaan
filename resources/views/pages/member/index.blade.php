@extends('layouts.app')

@section('title', $title)

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary font-weight-bold">{{ $title }}</h1>
                @can('members.create')
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <a href="{{ route('member.create') }}" type="button" class="btn btn-primary">New {{ str($title)->singular }}</a>
                    </div>
                @endcan
            </div>
            <div class="card">
                <div class="card-body">
                    <x-datatable :tableId="'member'" :tableHeaders="['Name', 'Nomor Anggota', 'Username', 'Email', 'Alamat', 'Action']" :tableColumns="[['data' => 'name'], ['data' => 'kartu'], ['data' => 'username'], ['data' => 'email'], ['data' => 'address'], ['data' => 'action']]" :getDataUrl="route('datatables.members')" />
                </div>
            </div>
        </div>
    </div>
@endsection
