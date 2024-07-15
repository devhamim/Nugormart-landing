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
                                    <td><a href="https://landing.nugormart.com/karijma/stone">https://landing.nugormart.com/karijma/stone</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><a href="https://landing.nugormart.com/batik/dress">https://landing.nugormart.com/batik/dress</a></td>
                                </tr>
                                @foreach ($products as $sl=>$product)
                                    <tr>
                                        <td>{{ $sl+3 }}</td>
                                        <td><a href="{{ url('/landing/'. $product->slug) }}">https://landing.nugormart.com/{{ $product->slug }}</a></td>
                                    </tr>
                                @endforeach
                                {{-- <tr>
                                    <td>2</td>
                                    <td><a href="https://cottonbd.nitebiz.com/landing/page">https://cottonbd.nitebiz.com/landing/page</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><a href="https://cottonbd.nitebiz.com/putul/dress">https://cottonbd.nitebiz.com/putul/dress</a></td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>4</td>
                                    <td><a href="https://cottonbd.nitebiz.com/sharee">https://cottonbd.nitebiz.com/sharee</a></td>
                                </tr> --}}

                                {{-- <tr>
                                    <td>6</td>
                                    <td><a href="https://cottonbd.nitebiz.com/premium/dress">https://cottonbd.nitebiz.com/premium/dress</a></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><a href="https://cottonbd.nitebiz.com/fotula">https://cottonbd.nitebiz.com/fotula</a></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><a href="https://cottonbd.nitebiz.com/premium/tiya">https://cottonbd.nitebiz.com/premium/tiya</a></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
