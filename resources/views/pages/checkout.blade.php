@extends('layouts.app-public')
@section('title', 'Checkout')

@section('content')
<div class="site-wrapper-reveal">
    <div class="section-space--pt_90 border-bottom pb-5 mb-5">
        <div class="container">
            <h2 class="mb-4">Checkout</h2>

            <div class="row" id="checkout-container">
                <p class="text-muted">Loading checkout details...</p>
            </div>

        </div>
    </div>
</div>
@endsection

@section('addition_script')
<script src="{{ asset('pages/js/checkout.js') }}"></script>
@endsection

@section('addition_css')
<style>
    h2 {
        margin-left: 44%;
        font-weight: 800;
    }
</style>
@endsection
