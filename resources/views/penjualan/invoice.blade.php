<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Invoice {{$data->no_transaksi}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="{{asset('SimpleInvoice/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('SimpleInvoice/font-awesome/css/font-awesome.min.css')}}" />

    <script type="text/javascript" src="{{asset('SimpleInvoice/js/jquery-1.10.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('SimpleInvoice/bootstrap/js/bootstrap.min.js')}}"></script>
</head>
<body>

<div class="container">
<!-- Simple Invoice - START -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <h2>Nota Pembelian #{{$data->no_transaksi}}</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Billing Details</div>
                        <div class="panel-body">
                            <strong>{{$data->nama}}:</strong><br>
                            {{$data->alamat}}<br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Payment Information</div>
                        <div class="panel-body">
                            <strong>Tanggal Transaksi:</strong> {{$data->tanggal}}<br>
                            <strong>Tanggal Jatuh Tempo: </strong> 
                            @isset($data->deadline)
                            {{$data->deadline}}
                            @else
                            <b>-</b>
                            @endisset
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Status Pembayaran</div>
                        <div class="panel-body">
                            <strong>Status Pembayaran:</strong> 
                            @isset($data->deadline)
                                @if($data->status == 0)
                                Belum Lunas<br>
                                @else
                                Lunas<br>
                                @endif
                            @else
                                Lunas
                                <br>
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Shipping Address</div>
                        <div class="panel-body">
                            @isset($data->alamat_pengiriman)
                            <strong>{{$data->nama}}:</strong><br>
                            {{$data->alamat_pengiriman}}<br>
                            @else
                            -
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Item Name</strong></td>
                                    <td class="text-center"><strong>Item Price</strong></td>
                                    <td class="text-center"><strong>Item Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangPembelian as $barang)
                                <tr>
                                    <td>{{$barang->namaBarang}}</td>
                                    <td class="text-center">Rp. {{$barang->harga}}</td>
                                    <td class="text-center">{{$barang->kuantitas}}</td>
                                    <td class="text-right">Rp. {{$barang->harga * $barang->kuantitas}}</td>
                                @endforeach
                                </tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right">Rp.{{$data->total}}</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                    <td class="emptyrow text-right">Rp.15000</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-right">Rp.{{$data->total + 15000}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if(Request::get('submit')=='yes')
                        <button class="btn btn-success" form="submitForm">Bayar</button>
                        <form id="submitForm" action="/submitPembayaran" method="post">
                        @csrf
                            <input type="text" name="no_transaksi" value="{{$data->no_transaksi}}" hidden>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}
</style>

<!-- Simple Invoice - END -->

</div>

</body>
</html>