@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column gap-4 bg-secondary px-3 py-4 text-dark bg-opacity-10 w-100">
        <div class="d-flex flex-row bg-white rounded py-2 px-3 border border-2 border-secondary">
            <h1>Alternatif</h1>
        </div>
        <div class="d-flex gap-3 flex-row">
            <div class="w-25 bg-white border border-2 border-secondary rounded" style="height: 300px">
                <div class="p-2 bg-secondary text-white rounded">
                    <h2>Form Control</h2>
                </div>
                <form action="{{route('alternatif.store')}}" method="POST" enctype="multipart/form-data" enctype="multipart/form-data" class="d-flex px-5 py-4 flex-column gap-2 text-center" >
                    @csrf
                    <label class="fw-bold fs-4" for="name_alternatif">Alternatif</label>
                    <input type="text" name="name_alternatif" id="name_alternatif" class="form-control border border-secondary border-2" placeholder="" aria-describedby="name_alternatif">
                    <button type="submit" class="btn btn-outline-secondary w-75 m-auto">Simpan</button>
                </form>
            </div>
            <div class="w-75 bg-white border border-2 border-secondary rounded">
                <div class="p-2 bg-secondary text-white rounded">
                    <h2 class="mx-2">List Alternatif</h2>
                </div>
                <div class="p-3">
                    <table class="table table-hover text-center">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Alternatif</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatif as $index => $alt)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $alt->name_alternatif}}</td>
                                <td class="d-flex flex-row justify-content-center gap-2 ">
                                    {{-- Modal Button --}}
                                    <button data-bs-target="#edit-modal-{{$alt->id}}" data-bs-toggle="modal" class="btn btn-primary h-100" type="button">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                  <!-- Modal -->
                                    <div class="modal fade" id="edit-modal-{{$alt->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content border border-secondary border-2">
                                            <div class="modal-header bg-primary text-white">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{$alt->name_alternatif}}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="{{ route('alternatif.update', $alt->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded px-8 flex flex-col h-full">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class=" d-flex flex-column gap-4 mb-4 ">
                                                        <div class="d-flex flex-column gap-3 justify-content-start">
                                                            <label for="name" class=" text-start fw-bold font-medium text-gray-900">Alternatif</label>
                                                            <input type="text" name="name_alternatif" id="name_alternatif" class="form-control" placeholder="" aria-describedby="name_kriteria" value="{{$alt->name_alternatif}}">
                                                        </div>
                                                        <div class="col-span-2">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    {{-- Delete Button --}}
                                    <form action="{{route('alternatif.destroy', $alt->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
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