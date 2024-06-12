@extends('layouts.app')

@section('title')
    Home
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="card" style="width: 18rem;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Solid_grey.svg" class="card-img-top" alt="...">
                <div class="card-body">
                    @auth
                    <h5 class="card-title text-center">{{ auth()->user()->name }}</h5>
                    @endauth
                </div>
            </div>
            <div class="ml-4 mt-3">
                <div class="row">
                    <div class="cardInfo">
                        <div class="p-3">
                            <div class="">
                                <div class="">
                                    <div class="Rectangle"></div>
                                </div>
                                <div class="textInfo">
                                    <p>Total Members</p>
                                </div>
                            </div>
                             <div class="number">    
                                 <h4>10</h4>
                            </div>
                        </div>
                    </div>
                    <div class="cardInfo">
                        <div class="p-3">
                            <div class="">
                                <div class="">
                                    <div class="Rectangle"></div>
                                </div>
                                <div class="textInfo">
                                    <p>Total Books</p>
                                </div>
                            </div>
                             <div class="number">    
                                 <h4>300</h4>
                            </div>
                        </div>
                    </div>
                    <div class="cardInfo">
                        <div class="p-3">
                            <div class="">
                                <div class="">
                                    <div class="Rectangle"></div>
                                </div>
                                <div class="textInfo">
                                    <p>Total Books Borrwing</p>
                                </div>
                            </div>
                             <div class="number">    
                                 <h4>100</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="">
                        {{-- Grafik --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
