@extends('layout.app')

@section('title', 'Daftar Jenis Pembayaran')

@section('contents')
<div class="container mt-4">
    <h1>Daftar Jenis Pembayaran</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- Tabel Jenis Pembayaran -->
        <div class="col-md-6">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Jenis Pembayaran</th>
                        <th class="text-center">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">Cash</td>
                        <td class="text-center">Pembayaran secara tunai</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td class="text-center">E-Wallet</td>
                        <td class="text-center">
                            <select id="ewalletProvider" class="form-control" onchange="showBankOptions('ewallet')">
                                <option value="">--Pilih Ewallet--</option>
                                <option value="ovo">OVO</option>
                                <option value="gopay">GoPay</option>
                                <option value="dana">DANA</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td class="text-center">Transfer Bank</td>
                        <td class="text-center">
                            <select id="bankProvider" class="form-control" onchange="showBankOptions('bank')">
                                <option value="">--Pilih Bank--</option>
                                <option value="bca">BCA</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="bni">BNI</option>
                                <option value="bri">BRI</option>
                                <option value="syariah">Bank Syariah</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Display Selected Bank or E-Wallet Detail -->
    <div id="selectedDetail" class="mt-4"></div>
</div>

<script>
    function showBankOptions(type) {
        let selectedOption = '';
        let displayDiv = document.getElementById('selectedDetail');
        
        if (type === 'ewallet') {
            selectedOption = document.getElementById('ewalletProvider').value;
            if (selectedOption) {
                displayDiv.innerHTML = `<p><strong>Selected E-Wallet:</strong> ${selectedOption.toUpperCase()}</p>`;
            } else {
                displayDiv.innerHTML = '';
            }
        }

        if (type === 'bank') {
            selectedOption = document.getElementById('bankProvider').value;
            if (selectedOption) {
                displayDiv.innerHTML = `<p><strong>Selected Bank:</strong> ${selectedOption.toUpperCase()}</p>`;
            } else {
                displayDiv.innerHTML = '';
            }
        }
    }
</script>

@endsection
