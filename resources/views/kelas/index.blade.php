@extends('template')

@section('main')
    <div id="kelas">
        <h2>Kelas</h2>

        @include('_partial.flash_message')

        @if (count($kelas_list) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                         @if (Auth::check() && Auth::user()->level == 'admin' || Auth::user()->level == 'guru')
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach($kelas_list as $kelas): ?>
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                        <td>
                         @if (Auth::check() && Auth::user()->level == 'admin' || Auth::user()->level == 'guru')
                            <div class="box-button">
                                {{ link_to('kelas/' . $kelas->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
                            </div>
                            <div class="box-button">
                                {!! Form::open(['method' => 'DELETE', 'action' => ['KelasController@destroy', $kelas->id]]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        @else
            <p>Tidak ada data kelas.</p>
        @endif

        <div class="table-nav">
         @if (Auth::check() && Auth::user()->level == 'admin' || Auth::user()->level == 'guru')
            <div class="tombol-nav">
                <a href="kelas/create" class="btn btn-primary">Tambah Kelas</a>
            </div>
        @endif
            <div class="jumlah-data">
                <strong>Jumlah kelas : {{ $jumlah_kelas }}</strong>
            </div>
        </div>
    </div> <!-- / #kelas -->
@stop

@section('footer')
   @include('footer')
@stop