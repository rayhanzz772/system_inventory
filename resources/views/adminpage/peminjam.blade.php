<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- JavaScript Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../assets/css/pinjam.css">
    <link rel=" preconnect " href="https://fonts.googleapis.com ">
    <link rel="preconnect " href="https://fonts.gstatic.com " crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap " rel="stylesheet ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- data tables --}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../assets/admin_lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    {{--  --}}
    <title>PEMINJAMAN MAHASISWA</title>
    <style>
        .form-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group input {
            padding: 5px;
        }
    </style>
</head>

<body>
    <header>
        @include('layouts.navbar')

    </header>
    <section class="table">
        <div class="container mt-5">
            <h1 style="font-size: 3em; font-weight: bold;">Data Peminjaman</h1>
            {{-- statistik --}}
            <div class="stats-container">
                <div class="stat-box selesai">
                    <i class="fas fa-check-circle stat-icon"></i>
                    <div>
                        <div class="stat-title">Selesai</div>
                        <div class="stat-count">{{ $countSelesai }}</div>
                    </div>
                </div>
                <div class="stat-box diajukan">
                    <i class="fas fa-hourglass-start stat-icon"></i>
                    <div>
                        <div class="stat-title">Diajukan</div>
                        <div class="stat-count">{{ $countDiajukan }}</div>
                    </div>
                </div>
                <div class="stat-box dipinjamkan">
                    <i class="fas fa-hand-holding-usd stat-icon"></i>
                    <div>
                        <div class="stat-title">Dipinjamkan</div>
                        <div class="stat-count">{{ $countDipinjamkan }}</div>
                    </div>
                </div>
            </div>
            {{-- end of statistik --}}
            <form id="timeRangeForm" class="form-container">
                @csrf
                <div class="form-group">
                    <input type="date" id="start_date" name="start_date" required>
                </div>
                <div>--</div>
                <div class="form-group">
                    <input type="date" id="end_date" name="end_date" required>
                </div>
                <div class="form-group">
                    <button
                        style="display: inline-flex; align-items: center; padding: 10px; background-color: #007bff; color: white; text-decoration: none; border: none; border-radius: 5px;
            transition: transform 0.2s;"
                        type="submit">
                        <i class="fas fa-download"></i>

                    </button>
                </div>

            </form>

            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th class="">No</th>
                        <th class="col-md-1">NIM</th>
                        <th class="col-md-2">Nama Peminjam</th>
                        <th class="col-md-1">Dosen</th>
                        <th class="col-md-1">Ruang</th>
                        <th class="col-md-2">Mata Kuliah</th>
                        <th class="col-md-2">Waktu Pinjam</th>
                        <th class="col-md-1">Nama dan Jumlah Alat</th>
                        <th class="col-md-1">Keterangan</th>
                        <th class="col-md-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data['status']) && $data['status'] === 'error')
                        <tr class="text-center">
                            <td colspan="12">{{ $data['message'] }}</td>
                        </tr>
                    @else
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($data['data'] as $item)
                            @if (isset($item['nim']) && $item['nim'] != intval(session('nim')))
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $item['nim'] }}</td>
                                    <td>{{ $item['nama_peminjam'] }}</td>
                                    <td>{{ $item['dosen'] }}</td>
                                    <td>{{ $item['ruang'] }}</td>
                                    <td>{{ $item['mata_kuliah'] }}</td>
                                    <td>{{ $item['formatted_tanggal_waktu_peminjaman'] }}</td>
                                    <td>
                                        <div>
                                            {{ $item['nama_alat_1'] }},
                                            {{ $item['jumlah_alat_1'] }}
                                        </div>
                                        @if ($item['nama_alat_2'] !== null && $item['jumlah_alat_2'] !== null)
                                            <div>
                                                {{ $item['nama_alat_2'] }},
                                                {{ $item['jumlah_alat_2'] }}
                                            </div>
                                        @endif
                                        @if ($item['nama_alat_3'] !== null && $item['jumlah_alat_3'] !== null)
                                            <div>
                                                {{ $item['nama_alat_3'] }},
                                                {{ $item['jumlah_alat_3'] }}
                                            </div>
                                        @endif
                                        @if ($item['nama_alat_4'] !== null && $item['jumlah_alat_4'] !== null)
                                            <div>
                                                {{ $item['nama_alat_4'] }},
                                                {{ $item['jumlah_alat_4'] }}
                                            </div>
                                        @endif
                                        @if ($item['nama_alat_5'] !== null && $item['jumlah_alat_5'] !== null)
                                            <div>
                                                {{ $item['nama_alat_5'] }},
                                                {{ $item['jumlah_alat_5'] }}
                                            </div>
                                        @endif
                                    </td>
                                    <?php
                                    // Misalkan $item adalah array yang berisi data Anda, dan $item['keterangan'] adalah keterangan yang menentukan teks yang akan ditampilkan.
                                    
                                    // Menggunakan struktur percabangan if-else untuk menentukan teks yang akan ditampilkan.
                                    if ($item['keterangan'] === 'Diajukan') {
                                        $spanText = 'Setujui';
                                    } elseif ($item['keterangan'] === 'Dipinjamkan') {
                                        $spanText = 'Selesai';
                                    } else {
                                        // Jika kondisi lainnya, teks akan tetap 'Pinjam'.
                                        $spanText = '-';
                                    }
                                    ?>
                                    <td>
                                        @if ($item['keterangan'] === 'Diajukan')
                                            <span class="badge badge-primary">
                                                <i class="fas fa-paper-plane" style="margin-right: 5px;"></i> Diajukan
                                            </span>
                                        @elseif ($item['keterangan'] === 'Dipinjamkan')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-handshake" style="margin-right: 5px;"></i> Dipinjamkan
                                            </span>
                                        @elseif ($item['keterangan'] === 'Selesai')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check" style="margin-right: 5px;"></i> Selesai
                                            </span>
                                        @endif
                                    </td>



                                    <td>
                                        @if ($item['keterangan'] === 'Diajukan')
                                            <form id="updateForm{{ $item['id'] }}"
                                                action="{{ route('pinjam.update', ['id' => $item['id']]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <!-- Isi formulir dengan input yang sesuai untuk melakukan pembaruan data -->
                                                <!-- Contoh: -->
                                                <input hidden type="text" name="keterangan" value="Dipinjamkan">

                                                <input hidden type="text" name="jumlah_alat_1"
                                                    value="{{ $item['jumlah_alat_1'] }}">


                                                <input hidden type="text" name="id_alat_1"
                                                    value="{{ $item['id_alat_1'] }}">


                                                @if ($item['jumlah_alat_2'] !== null && $item['id_alat_2'] !== 0)
                                                    <input hidden type="text" name="jumlah_alat_2"
                                                        value="{{ $item['jumlah_alat_2'] }}">

                                                    <input hidden type="text" name="id_alat_2"
                                                        value="{{ $item['id_alat_2'] }}">
                                                @endif

                                                @if ($item['jumlah_alat_3'] !== null && $item['id_alat_2'] !== 0)
                                                    <input hidden type="text" name="jumlah_alat_3"
                                                        value="{{ $item['jumlah_alat_3'] }}">

                                                    <input hidden type="text" name="id_alat_3"
                                                        value="{{ $item['id_alat_3'] }}">
                                                @endif

                                                @if ($item['jumlah_alat_4'] !== null && $item['id_alat_2'] !== 0)
                                                    <input hidden type="text" name="jumlah_alat_4"
                                                        value="{{ $item['jumlah_alat_4'] }}">

                                                    <input hidden type="text" name="id_alat_4"
                                                        value="{{ $item['id_alat_4'] }}">
                                                @endif

                                                @if ($item['jumlah_alat_5'] !== null && $item['id_alat_2'] !== 0)
                                                    <input hidden type="text" name="jumlah_alat_5"
                                                        value="{{ $item['jumlah_alat_5'] }}">

                                                    <input hidden type="text" name="id_alat_5"
                                                        value="{{ $item['id_alat_5'] }}">
                                                @endif


                                                <!-- Tambahkan input lainnya sesuai dengan kebutuhan -->

                                                <button id="submitButton{{ $item['id'] }}" type="button"
                                                    class="btn btn-success"
                                                    onclick="showConfirmationModal({{ $item['id'] }})" <span
                                                    style="text-decoration: none;"><?php echo $spanText; ?></span>
                                                </button>

                                            </form>
                                        @elseif ($item['keterangan'] === 'Dipinjamkan')
                                            <form id="updateFormSelesai{{ $item['id'] }}"
                                                action="{{ route('pinjam.update', ['id' => $item['id']]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <!-- Isi formulir dengan input yang sesuai untuk melakukan pembaruan data -->
                                                <!-- Contoh: -->
                                                <input hidden type="text" name="keterangan" value="Selesai">

                                                <input hidden type="text" name="jumlah_alat_1"
                                                    value="{{ $item['jumlah_alat_1'] }}">


                                                <input hidden type="text" name="id_alat_1"
                                                    value="{{ $item['id_alat_1'] }}">


                                                @if ($item['jumlah_alat_2'] !== null && $item['id_alat_2'] !== 0)
                                                    <input hidden type="text" name="jumlah_alat_2"
                                                        value="{{ $item['jumlah_alat_2'] }}">

                                                    <input hidden type="text" name="id_alat_2"
                                                        value="{{ $item['id_alat_2'] }}">
                                                @endif

                                                @if ($item['jumlah_alat_3'] !== null && $item['id_alat_2'] !== 0)
                                                    <input hidden type="text" name="jumlah_alat_3"
                                                        value="{{ $item['jumlah_alat_3'] }}">

                                                    <input hidden type="text" name="id_alat_3"
                                                        value="{{ $item['id_alat_3'] }}">
                                                @endif

                                                @if ($item['jumlah_alat_4'] !== null && $item['id_alat_2'] !== 0)
                                                    <input hidden type="text" name="jumlah_alat_4"
                                                        value="{{ $item['jumlah_alat_4'] }}">

                                                    <input hidden type="text" name="id_alat_4"
                                                        value="{{ $item['id_alat_4'] }}">
                                                @endif

                                                @if ($item['jumlah_alat_5'] !== null && $item['id_alat_2'] !== 0)
                                                    <input hidden type="text" name="jumlah_alat_5"
                                                        value="{{ $item['jumlah_alat_5'] }}">

                                                    <input hidden type="text" name="id_alat_5"
                                                        value="{{ $item['id_alat_5'] }}">
                                                @endif

                                                <button id="submitButton{{ $item['id'] }}" type="button"
                                                    class="btn btn-primary" style="text-decoration: none;"
                                                    onclick="showConfirmationModalSelesai({{ $item['id'] }})">
                                                    <span style="text-decoration: none;"><?php echo $spanText; ?></span>
                                                </button>

                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif

                </tbody>
            </table>

    </section>
    <!-- Modal Konfirmasi Pembaruan -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Pembaruan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="hideConfirmationModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin memperbarui data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="hideConfirmationModal()">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updateItem()">Perbarui</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModalSelesai" tabindex="-1" role="dialog"
        aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Penyelesaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="hideConfirmationModalSelesai()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyelesaikan data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="hideConfirmationModalSelesai()">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="updateItemSelesai()">Selesai</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('timeRangeForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const startDateInput = document.getElementById('start_date').value;
            const endDateInput = document.getElementById('end_date').value;

            const formatDateTime = (dateTimeStr) => {
                const options = {
                    day: '2-digit',
                    month: '2-digit',
                    year: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                };
                const date = new Date(dateTimeStr);
                const formattedDate = date.toLocaleString('en-GB', options).replace(',', '');
                return formattedDate;
            };

            const formattedStartDate = formatDateTime(startDateInput);
            const formattedEndDate = formatDateTime(endDateInput);

            window.location.href = `/download-pdf?start_date=${formattedStartDate}&end_date=${formattedEndDate}`;
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        var updateItemId;

        function showConfirmationModal(itemId) {
            updateItemId = itemId;
            $('#confirmationModal').modal('show');
        }

        function showConfirmationModalSelesai(itemId) {
            updateItemId = itemId;
            $('#confirmationModalSelesai').modal('show');
        }

        function hideConfirmationModal() {
            $('#confirmationModal').modal('hide');
        }

        function hideConfirmationModalSelesai() {
            $('#confirmationModalSelesai').modal('hide');
        }

        function updateItem() {
            if (updateItemId) {
                var updateForm = document.getElementById('updateForm' + updateItemId);
                updateForm.submit();
            }
        }

        function updateItemSelesai() {
            if (updateItemId) {
                var updateFormSelesai = document.getElementById('updateFormSelesai' + updateItemId);
                updateFormSelesai.submit();
            }
        }
    </script>

    <script src="../assets/js/profile.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn_hapus').click(function() {
                var itemId = $(this).data('itemid');
                // Set nilai dari input dengan id "id_alat" dengan nilai itemId
                $('#id_alat').val(itemId);
                // Lakukan apa pun yang perlu Anda lakukan dengan itemId di sini
                console.log("ID Alat yang Dipinjam: " + itemId);
                // Misalnya, Anda dapat membuat permintaan AJAX untuk mengirimkan ID alat ke server untuk memproses permintaan peminjaman
            });
        });
    </script>


</body>

</html>
