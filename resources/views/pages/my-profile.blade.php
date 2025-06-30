@extends('layouts.app-public')
@section('title', 'My Profile')
@section('content')
<div class="site-wrapper-reveal">
    <div class="single-product-wrap section-space--ptb_90 border-bottom pb-5 mb-5">
        <div class="container">
            <h2 class="mb-4">Your Profile</h2>

            @if(@$_COOKIE['ut'] && @$_COOKIE['ue'])
                <div class="card p-4 shadow-sm">
                    <h5 class="mb-3">Account Information</h5>
                    <p><strong>Name :</strong> Ada Lovelace</p>
                    <p><strong>Email :</strong> {{ $_COOKIE['ue'] }}</p>
                    <p><strong>Birth date :</strong> <input type="date"></input></p>
                    <p><strong>Address :</strong> Jakarta Barat</p>
                </div>
            @else
                <div class="alert alert-warning">
                    Kamu belum login. Silakan login dari tombol akun di kanan atas.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('addition_css')
<style>
    h5 {
        margin-left: 40%;
    }
    
    p {
        margin-left: 35%;
    }
</style>
@endsection
