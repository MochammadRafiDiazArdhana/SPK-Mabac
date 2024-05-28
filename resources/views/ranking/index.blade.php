@extends('layouts.app')

@section('content')
<div class="d-flex flex-column gap-4 bg-secondary px-3 py-4 text-dark bg-opacity-10 w-100">
    <div class="bg-white rounded py-2 px-3 border border-2 border-secondary">
        <h1>Perhitungan dan Ranking</h1>
    </div>
    <div class="bg-white rounded py-4 px-3 border border-2 border-secondary">
      
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
        Lihat Perhitungan
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
              <button type="button" class="close bg-secondary text-white border border-light rounded" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{-- daftar perhitungan --}}
              {{-- 1. Matriks Penilaian --}}
              <div class="p-2 mt-1 mb-3  border border-2 border-light rounded">
                <div class="bg-secondary text-white rounded p-2">
                  <h5 class="mt-2">1. Matriks Penilaian</h5>
                </div>
                <div class="w-100 m-auto py-2">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Alternatif</th>
                        @foreach ($kriteria as $index => $c)
                        <th scope="col">C{{ $index+1}}</th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatif as $a)
                        <tr>
                            <th class="fw-normal">{{ $a->name_alternatif }}</th>
                            @foreach ($kriteria as $c)
                            @php
                            $penilaianRecord = $penilaian
                                ->where('id_kriteria', $c->id)
                                ->where('id_alternatif', $a->id)
                                ->first();
                                @endphp
                            <td>{{ $penilaianRecord ? $penilaianRecord->value : 0 }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              {{-- 2. Matriks Normalisasi --}}
              <div class="p-2 mt-1 mb-3 border border-2 border-light rounded">
                <div class="bg-secondary text-white rounded p-2">
                  <h5 class="mt-2">2. Matriks Normalisasi</h5>
                </div>
                  <div class="w-100 m-auto py-2">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Alternatif</th>
                          @foreach ($kriteria as $index => $c)
                          <th scope="col">C{{ $index+1}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($alternatif as $a)
                          <tr>
                              <th class="fw-normal">{{ $a->name_alternatif }}</th>
                              @foreach ($kriteria as $c)
                              {{-- @php
                                                                $penilaianRecord = $penilaian
                                                                    ->where('id_kriteria', $c->id)
                                                                    ->where('id_alternatif', $a->id)
                                                                    ->first();
                                                                 @endphp --}}
                              <td>{{ $normalisasi[$c->id][($a->id)-1] ?? '0' }}</td>
                              @endforeach
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              {{-- 3. Matriks Tertimbang (V) --}}
              <div class="p-2 mt-1 mb-3 border border-2 border-light rounded">
                <div class="bg-secondary text-white rounded p-2">
                  <h5 class="mt-2">3. Matriks Tertimbang (V)</h5>
                </div>
                  <div class="w-100 m-auto py-2">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Alternatif</th>
                          @foreach ($kriteria as $index => $c)
                          <th scope="col">C{{ $index+1}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($alternatif as $a)
                          <tr>
                              <th class="fw-normal">{{ $a->name_alternatif }}</th>
                              @foreach ($kriteria as $c)
                              <td>
                                  {{ $pembobotan[$c->id][$a->id-1] ?? '0' }}
                              </td>
                              @endforeach
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
              {{-- 4. Penentuan Matriks Area Perkiraan Batas (G) --}}
              <div class="p-2 mt-1 mb-3 border border-2 border-light rounded">
                <div class="bg-secondary text-white rounded p-2">
                  <h5 class="mt-2">4. Penentuan Matriks Area Perkiraan Batas (G)</h5>
                </div>  
                  <div class="w-100 m-auto py-2">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Alternatif</th>
                          @foreach ($kriteria as $index => $c)
                          <th scope="col">C{{ $index+1}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <th class="fw-normal">G</th>
                              @foreach ($kriteria as $c)
                              <td>
                                  {{ $perkiraanBatas[$c->id] ?? '0' }}
                              </td>
                              @endforeach
                          </tr>
                      </tbody>
                    </table>
                  </div>
              </div>
              {{-- 5. Perhitungan elemen matriks jarak alternatif dari daerah perkiraan perbatasan (Q) --}}
              <div class="p-2 mt-1 mb-3 border border-2 border-light rounded">
                <div class="bg-secondary text-white rounded p-2">
                  <h5 class="mt-2">5. Perhitungan elemen matriks jarak alternatif dari daerah perkiraan perbatasan (Q)</h5>
                </div>
                  <div class="w-100 m-auto py-2">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Alternatif</th>
                          @foreach ($kriteria as $index => $c)
                          <th scope="col">C{{ $index+1}}</th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($alternatif as $a)
                          <tr>
                              <th class="fw-normal">{{ $a->name_alternatif }}</th>
                              @foreach ($kriteria as $c)
                              <td>
                                  {{ $jarakAlternatif[$c->id][($a->id)-1] ?? '0' }}
                              </td>
                              @endforeach
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
      {{-- Ranking --}}
      <div class="w-50 m-auto">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Ranking</th>
              <th scope="col">Alternatif</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($ranking as $alternativeId => $total)
            @php
                $alternative = $alternatif->where('id', $alternativeId)->first();
            @endphp
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td> {{ $alternative->name_alternatif }}</td>
              <td> {{ number_format($total, 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection