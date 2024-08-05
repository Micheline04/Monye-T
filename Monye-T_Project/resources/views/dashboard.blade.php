@extends('components.navbar')

@section('style')
<link rel="stylesheet" href="{{ asset('popup/popup.css') }}">
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .w-85 {
        width: 85%;
    }

    .historyCard {
        background-color: #ffffff;
        border: 0.8px solid #00000040;
        border-radius: 15px;
        padding: 15px;
    }

    .dompetCard {
        width: 200px;
        height: 120px;
        border-radius: 8px;
        box-shadow: 0 4px 4px 0 #0000004f;
        flex-shrink: 0;
        cursor: pointer;
    }

    .LightYellow {
        background-color: #fbd4545b;
    }

    .YellowMore {
        background-color: #FBD354;
    }

    .dompetScroll {
        height: 145px;
        overflow-x: scroll;
        flex-shrink: 0;
    }

    .dompetScroll::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .dompetScroll::-webkit-scrollbar {
        height: 15px;
        background-color: #F5F5F5;
    }

    .dompetScroll::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #fbd4545b;
    }


    body {
        background-color: #FDFCF7;
    }

    .boldFont {
        font-weight: 700;

    }

    .Dashboard {
        scale: 0.9
    }
    .IncreaseNumber{
        color: #24572F;
        font-weight: 700;
        font-style: italic;
    }
    .DecreaseNumber{
        color: #EC0D0D;
        font-weight: 700;
        font-style: italic;
    }
    .cardAnggaranEnd{
        border-left: 5px #FEEE72 solid;
    }
    .text-yellow-terpakai{
        color: #FBD354;
    }
</style>
@endsection



@section('content')
<!-- POPUP TAMBAH DOMPET -->
<div id="myPopup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <div class="header">
            <h1 class="header-title">Tambah Dompet</h1>
        </div>
        <form action="{{ route('input_dompet') }}" method="POST">
            @csrf
            <div class="field-group">
                <p class="TextField-title">Masukkan nama dompet barumu!</p>
                <input type="text" class="text-field" id="NamaDompet" name="namaDompet" placeholder="Nama Dompet Baru">
            </div>

            <div class="field-group">
                <p class="TextField-title">Masukkan saldo awal dompet barumu!</p>
                <div class="flex">
                    <span class="currency" aria-hidden="true">Rp</span>
                    <input type="text" class="text-field-saldo" id="SaldoAwal" name="saldoAwal" placeholder="Saldo Awal Dompet Baru" name="saldoAwal">
                </div>
            </div>

            <div class="w-100 d-flex justify-content-center">
                <button style="box-shadow: 0 2px 2px 0 #00000025;" type="submit" class="yellow-button">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- POPUP EDIT DOMPET -->
<div id="editPopUp" class="popup">
    <div class="popup-content">
        <span class="close" id="closeEdit">&times;</span>
        <div class="header">
            <h1 class="header-title">Edit Dompet</h1>
        </div>
        <form action="{{ route('edit_dompet') }}" method="POST">
            @csrf
            <input type="text" class="text-field" id="DompetID" name="DompetID" hidden>

            <div class="field-group">
                <p class="TextField-title">Nama Dompet</p>
                <input type="text" class="text-field" id="NamaDompetEdit" name="namaDompet" placeholder="Nama Dompet Baru" value="">
            </div>

            <div class="field-group">
                <p class="TextField-title">Saldo Dompet</p>
                <div class="flex">
                    <span class="currency" aria-hidden="true">Rp</span>
                    <input type="text" class="text-field-saldo" id="SaldoDompet" name="saldoDompet" placeholder="Saldo Dompet Baru">
                </div>
            </div>

            <div class="ButtonArea">
                <button style="box-shadow: 0 2px 2px 0 #00000025;" type="submit" class="yellow-button">Edit</button>
            </div>
        </form>
    </div>
</div>
@php
    $dompetUser = App\Models\User::find(auth()->user()->user_id)->dompets;
    $kategoriUser = App\Models\User::find(auth()->user()->user_id)->kategoris;
@endphp
<!-- Sebelum -->
<div class="Dashboard w-100 d-flex justify-content-center flex-column align-items-center">
    <div class="w-85 text-black ">
        <h2>Halo, {{ auth()->user()->username }}</h2>
        <h4>Apakah Kamu Sudah Mencatat Keuanganmu Hari ini?</h4>
    </div>
    <br>
    <br>
    <div class="w-85 text-black">
        <h3 class="boldFont">Dompet</h3>
        <div class="dompetScroll d-flex flex-row gap-5" style="margin-top: 30px;">

            {{-- Tambah Dompet --}}
            <a href="#myPopup" class="text-decoration-none text-black">
                <div class="addDompet  LightYellow dompetCard d-flex justify-content-center align-items-center"
                    id="tambahDompet">
                    <svg style="margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                    <h2 class="mb-0">Dompet</h2>
                </div>
            </a>

            {{-- View Semua Dompet User --}}
            @foreach($dompetUser as $dompet)
                <a onclick="showEditDompetPopUp('{{ $dompet->dompet_id }}', '{{ $dompet->nama_dompet }}', '{{ $dompet->jumlah_uang }}')" class="text-decoration-none text-black">
                    <div class="dompetList dompetCard YellowMore d-flex align-items-center p-3">
                        <div>
                            <h3 class="namaDompet" style="font-weight: 700;">{{ $dompet->nama_dompet }}</h3>
                            <h5 class="nominal_uang saldoDompet" style="font-weight: 400;" class="mt-3">{{ $dompet->jumlah_uang }}</h5>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <br>
    <br>
    <div class=" d-flex justify-content-between" style="width: 85%;">
        <div class="w-50" style="margin-right: 200px;">
        <h3 class="boldFont">Riwayat Transaksi</h3>

        @php
            $pencatatans = auth()->user()->pencatatans()->orderBy('tanggal', 'desc')->orderBy('pencatatan_id', 'desc')->take(3)->get();
        @endphp

        @if (count($pencatatans) != 0)
            @foreach ($pencatatans as $pencatatan)
                @php
                    $kategori = App\Models\Kategori::findOrFail($pencatatan->kategoris_id);
                    $dompet = App\Models\Dompet::findOrFail($pencatatan->dompets_id);
                @endphp

                <div class="historyCard mt-2 w-85 d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-row gap-3 align-items-center">
                        {{-- TODO:ini gambarnya belum sesuai kategori -> dibikin if else --}}
                        <img width="60" height="60" src="{{asset('../assets/Dashboard/IconKategori.png')}}" alt="">
                        <div>
                            <h5 style="font-weight: 600;">{{ $kategori->nama_kategori }}</h5>
                            <h5 style="font-weight: 300;">{{ $dompet->nama_dompet }}</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-end">
                        <div class="d-flex align-items-center gap-2 ">
                            @if ($pencatatan->status == "Pemasukan")
                                <img width="25" height="25" src="{{asset('../assets/Dashboard/UpArrow.png')}}" alt="">
                                <h5 class="nominal_uang IncreaseNumber mb-1">{{ $pencatatan->jumlah }}</h5>
                            @else
                                <img width="25" height="25" src="{{asset('../assets/Dashboard/DownArrow.png')}}" alt="">
                                <h5 class="nominal_uang DecreaseNumber mb-1">{{ $pencatatan->jumlah }}</h5>
                            @endif
                        </div>
                        <p class="m-0" style="font-weight: 600;">{{ $pencatatan->tanggal }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="d-flex w-100 align-items-center justify-content-center text-secondary" style="margin-top: 100px;">
                <h3>Tidak Ada Riwayat</h3>
            </div>
        @endif



        </div>
        <div style="width: 50%;">
            <div class="w-85">
                <h3 class="boldFont">Anggaran Yang Akan Berakhir</h3>
                @if (count($budgets) == 0)
                    <div class="d-flex w-100 align-items-center justify-content-center text-secondary" style="margin-top: 100px;">
                        <h3>Tidak Ada Anggaran</h3>
                    </div>
                @else
                    @foreach ($budgets as $budget)
                        @if($budget->jumlah != null)
                            <div class="cardAnggaranEnd mt-3 h-100 d-flex align-items-start justify-content-between">
                                <div style="width: 50%; margin-left: 10px;" class="d-flex h-100 flex-row align-items-start mt-3">
                                    <i class="bi bi-calendar-week"></i>
                                    <p style="font-weight: 700; margin-left: 5px;">{{ \Carbon\Carbon::parse($budget->tanggal_berakhir)->format('d M Y') }}</p>
                                </div>
                                <div class="historyCard d-flex flex-column justify-content-center w-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <img width="40" height="40" src="{{asset('../assets/Dashboard/IconKategori.png')}}" alt="">
                                        <h5 style="font-weight: 600;" class="m-0">{{$budget->nama_budget}}</h5>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <div class="w-50" style="margin-left: 10px;">
                                            <p class="m-0 w-50" style="font-weight: 600;">Terpakai</p>
                                            <p class="nominal_uang text-yellow-terpakai m-0" style="font-weight: 600;">{{$budget->digunakan}}</p>
                                        </div>
                                        <div class="w-50" style="margin-left:35px;">
                                            <p class="m-0" style="font-weight: 600;">Dari</p>
                                            <p class="nominal_uang m-0" style="font-weight: 600;">{{$budget->jumlah}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    @include('popup_Transaksi')
</div>
<div style="margin-left: 150px;">
    @include('components.flash')
</div>

<script src="{{ asset('/popup/popup.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    function showEditDompetPopUp(dompet_id, nama_dompet, jumlah_uang)
    {
        var edit_modal = document.getElementById("editPopUp");

        var txt_nama_dompet = document.getElementById("NamaDompetEdit");

        var txt_jumlah_uang = document.getElementById("SaldoDompet");

        var txt_dompet_id = document.getElementById("DompetID");

        txt_nama_dompet.value = nama_dompet;
        txt_jumlah_uang.value = jumlah_uang;
        txt_dompet_id.value = dompet_id;

        edit_modal.style.display = "block";

        // Ambil elemen <span> yang menutup modal
        var edit_span = document.getElementById("closeEdit");

        // Ketika <span> diklik, tutup modal
        edit_span.onclick = function() {
            edit_modal.style.display = "none";
        }

        // Ketika pengguna mengklik di luar modal, tutup modal
        window.onclick = function(event) {
            if (event.target == edit_modal) {
                edit_modal.style.display = "none";
            }
        }
    }

    document.querySelector('.HomeIcon').classList.add('active');

    $(document).ready(function() {
            $('#buttonAddKategori').click(function() {
                $('#PopupKategori').style.display = "block";
            });

            console.log(1);
            $(".nominal_uang").each(function() {
                var amount = $(this).text();
                $(this).text(formatRupiah(amount));
            });
    });

    function formatRupiah(angka) {
        var number_string = angka.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return 'Rp ' + rupiah;
    }

    </script>
@endsection
