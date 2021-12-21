@extends('layout')

@section('main')

<div class="container mt-3">
    <div class="d-flex justify-content-center">
        <h3>List Vaccine</h3>
    </div>

    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addvaccine">
            Add Vaccine
        </button>
    </div>

    @if ($vaccines->isNotEmpty())
    <table class="table table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th class="col-md-1">#</th>
                <th class="col">Name</th>
                <th class="col">Description</th>
                <th class="col-md-3">Image</th>
                <th class="col-md-3">Price</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vaccines as $vaccine)
            <tr>
                <th>{{$vaccine->id}}</th>
                <td>{{$vaccine->name}}</td>
                <td>{{$vaccine->description}}</td>
                <td><img src="/storage/{{$vaccine->image}}" width="100px" alt=""></td>
                <td>@currency($vaccine->price)</td>
                <td>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#editvaccine{{$vaccine->id}}" class="btn btn-warning mr-5">Edit</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deletevaccine{{$vaccine->id}}" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="d-flex justify-content-center mt-3">
        Theres no data vaccine yet.
    </div>
    @endif

    {{-- modal add vaccine --}}
    <div class="modal fade" id="addvaccine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Vaccine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/vaccine" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="basic-url" class="form-label">Vaccine Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="name">
                        </div>

                        <label for="basic-url" class="form-label">Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input class="input-currency form-control" name="price" type="text" type-currency="IDR" />
                        </div>

                        <label for="basic-url" class="form-label">Description</label>
                        <div class="input-group mb-3">
                            <input type="textarea" class="form-control" name="description">
                        </div>

                        <label for="basic-url" class="form-label">Image</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @foreach ($vaccines as $vaccine)
    {{-- modal edit vaccine --}}
    <div class="modal fade" id="editvaccine{{$vaccine->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Vaccine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/vaccine/update/{{$vaccine->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <label for="basic-url" class="form-label">Vaccine Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="name" value="{{$vaccine->name}}">
                        </div>

                        <label for="basic-url" class="form-label">Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input class="input-currency form-control" name="price" type="text" type-currency="IDR" value="{{$vaccine->price}}" />
                        </div>

                        <label for="basic-url" class="form-label">Description</label>
                        <div class="input-group mb-3">
                            <input type="textarea" class="form-control" name="description" value="{{$vaccine->description}}">
                        </div>

                        <label for="basic-url" class="form-label">Image</label>
                        @isset($vaccine->image)
                        <div class="p-0 mb-3">
                            <img src="/storage/{{$vaccine->image}}" width="200px" alt="">
                        </div>
                        @endisset
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- modal delete vaccine --}}
    <div class="modal fade" id="deletevaccine{{$vaccine->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Vaccine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/vaccine/delete/{{$vaccine->id}}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <h3>Are you sure delete "{{$vaccine->name}}"</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
    // input auto format currency
    document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
        element.addEventListener('keyup', function(e) {
            let cursorPostion = this.selectionStart;
            let value = parseInt(this.value.replace(/[^,\d]/g, ''));
            let originalLenght = this.value.length;
            if (isNaN(value)) {
                this.value = "";
            } else {
                this.value = value.toLocaleString('id-ID', {
                    currency: 'IDR',
                    // style: 'currency',
                    minimumFractionDigits: 0
                });
                cursorPostion = this.value.length - originalLenght + cursorPostion;
                this.setSelectionRange(cursorPostion, cursorPostion);
            }
        });
    });

</script>

@endsection
