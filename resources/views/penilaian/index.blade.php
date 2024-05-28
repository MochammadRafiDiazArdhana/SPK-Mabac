@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column gap-4 bg-secondary px-3 py-4 text-dark bg-opacity-10 w-100">
        <div class="bg-white rounded py-2 px-3 border border-2 border-secondary">
            <h1>Perhitungan</h1>
        </div>
            <div class=" bg-white border border-2 border-secondary rounded">
              <div class="p-2 bg-secondary text-white rounded">
                <h2 class="mx-2">Penilaian Awal</h2>
              </div>
                <div class="px-5 py-5">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Alternatif</th>
                            @foreach ( $kriteria as $index => $c)
                            <th scope="col">C {{ $index + 1 }}</th>
                            @endforeach
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $a)
                            <tr>
                                <td>{{ $a->name_alternatif }}</td>
                                @foreach ($kriteria as $c)
                                @php
                                $penilaianRecord = $penilaian
                                    ->where('id_kriteria', $c->id)
                                    ->where('id_alternatif', $a->id)
                                    ->first();
                                @endphp
                                <td>{{ $penilaianRecord ? $penilaianRecord->value : 0 }}</td>
                                @endforeach
                                <td > 
                                    {{-- button edit modal --}}
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-criterias-{{$a->id}}">
                                      <i class="bi bi-pencil-square"></i>
                                    </button>
                                      <!-- Modal -->
                                    <div class="modal fade" id="add-criterias-{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content border border-secondary border-2">
                                          {{-- modal header --}}
                                          <div class="modal-header bg-primary text-white">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $a->name_alternatif }}</h1>
                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          {{-- modal body --}}
                                          <div class="modal-body mt-2">
                                            <form id="add-criterias-{{ $a->id }}" action="{{route('penilaian.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded px-8 flex flex-col h-full">
                                              @csrf
                                              <div class=" d-flex flex-column gap-3 mb-4 ">
                                                <input type="text" name="id_alternatif" hidden value="{{ $a->id }}">
                                                @foreach ($kriteria as $c)
                                                    <div class="d-flex flex-row gap-1 justify-content-start">
                                                    <label for="nilai_{{ $c->id }}" class="w-25 text-start font-medium text-gray-900"> {{ $c->name_kriteria }}</label>
                                                    <input type="number" onchange="setTwoNumberDecimal" min="0" step="0.01" value="{{ $penilaianRecord ? $penilaianRecord->where('id_kriteria', $c->id)->where('id_alternatif', $a->id)->first()->value : 0 }}"
                                                        name="nilai[{{ $c->id }}]" id="nilai_{{ $c->id }}"
                                                        class="form-control"
                                                        placeholder="" required="">
                                                    </div>
                                                @endforeach
                                                <div class="col-span-2">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>  
@endsection