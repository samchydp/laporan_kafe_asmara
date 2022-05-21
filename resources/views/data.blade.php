@extends('template')

@section('title')
List Data Pelaporan Kafe Asmara
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pendapatan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pendapatan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header align-items-center">
                  <h3 class="card-title">Per Januari 2022</h3>

                  {{-- <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-xs">Export</button>
                  </div> --}}
                </div>
                <!-- /.card-header -->
                @php
                $no = 0;
                @endphp
                <div class="card-body p-0">
                  <table class="table" id="table">
                    <thead>
                      <tr>
                        <th style="width: 10px!important">#</th>
                        <th>Nama</th>
                        <th>Total Pendapatan</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $row)

                      <tr>
                        <td style="width: 10px!important">{{ (++$no) }}</td>
                        <td style="width: 20%!important">{{\ucfirst($row->name)}}</td>
                        <td>
                            Rp. {{number_format($row->total_income)}}
                        </td>
                        <td>{{ $row->tanggal }}</td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="4">Tidak ada data.</td>
                      </tr>
                      @endforelse
                      {{-- <tr>
                          <td colspan="4" class="w-100">
                              <div class="text-center d-flex justify-content-center w-100 mx-auto">
                                  {{$datas->links()}}
                              </div>
                          </td>
                      </tr> --}}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 10px!important">#</th>
                            <th>Nama</th>
                            <th>Total Pendapatan</th>
                            <th>Tanggal</th>
                        </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
    .dt-buttons{margin-left: 12px;}
    #table_wrapper{padding-top: 12px;}
    #table_filter{float: right;margin-right: 12px;}
    #table_info{display: none;}
    #table_paginate{margin-bottom: 12px;}
</style>
@endsection

@section('script')
<!-- DataTables  & Plugins -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/plugins/jszip/jszip.min.js"></script>
<script src="/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
$("#table").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "dom": 'Bfrtip',
    "buttons": [
        {
            extend: 'excelHtml5',
            title: 'Laporan ({{date('d-m-Y')}})'
        },
        {
            extend: 'pdfHtml5',
            title: 'Laporan ({{date('d-m-Y')}})'
        },
        {
            extend: 'print',
            text: 'Print',
            autoPrint: true
        },
        {
            extend: "colvis",
            text: 'Tampilan',
        }
    ]
}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
@endsection