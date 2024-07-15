@extends('backend.layouts.app')
@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>Landing Page List</h1>
            <p class="breadcrumbs"><span><a href="{{ route('dashboard') }}">Dashboard</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Landing Page
            </p>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="responsive-data-table" class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Link</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a target="_blanck" href="https://landing.nugormart.com/karijma/stone">https://landing.nugormart.com/karijma/stone</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a target="_blanck" href="https://landing.nugormart.com/batik/dress">https://landing.nugormart.com/batik/dress</a></td>
                                </tr>
                                @foreach ($products as $sl=>$product)
                                    <tr>
                                        <td>{{ $sl+3 }}</td>
                                        <td><a target="_blanck" href="{{ url('/landing/'. $product->slug) }}">https://landing.nugormart.com/{{ $product->slug }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
