<x-header></x-header>
<div class="container-fluid px-4">
    <h1 class="my-4">{{ $title }}</h1>
    <div class="card">
        <div class="card-header">
            <!-- Modal trigger button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new">
                New
            </button>

            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="new" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">New user</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/user" method="post">
                            @csrf
                            <div class="modal-body">
                                @if ($errors->any() && !old('id'))
                                    @php
                                        notifError($errors->all());
                                        $name = old('name');
                                        $email = old('email');
                                        $password = old('password');
                                    @endphp
                                @else
                                    @php
                                        $name = '';
                                        $email = '';
                                        $password = '';
                                    @endphp
                                @endif

                                <div class="form-floating mb-2">
                                    <input type="text" name="name" autofocus class="form-control" id="name"
                                        placeholder="User name" value="{{ $name }}">
                                    <label for="name">User name</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="email" name="email" autofocus class="form-control" id="email"
                                        placeholder="User email" value="{{ $email }}">
                                    <label for="email">User email</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="text" name="password" autofocus class="form-control" id="pw"
                                        placeholder="User password" {{ $password }}>
                                    <label for="pw">User password</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="Submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="tabel" class="table table-bordered border-dark">
                <thead class="bg-info">
                    <tr>
                        <th width="10%">No</th>
                        <th width="30%">Name</th>
                        <th width="20%">Email</th>
                        <th width="20%">Password</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->password2 }}</td>
                            <td>
                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $item->id }}">
                                    Edit
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">Edit user</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="/user/{{ $item->id }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    @if ($errors->any() && old('id') == $item->id)
                                                        @php
                                                            notifError($errors->all());
                                                            $na = old('name');
                                                            $em = old('email');
                                                            $pa = old('pw');
                                                        @endphp
                                                    @else
                                                        @php
                                                            $na = $item->name;
                                                            $em = $item->email;
                                                            $pa = $item->password2;
                                                        @endphp
                                                    @endif
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="form-floating mb-2">
                                                        <input type="text" name="name" autofocus
                                                            class="form-control" id="name" placeholder="User name"
                                                            value="{{ $na }}">
                                                        <label for="name">User name</label>
                                                    </div>
                                                    <div class="form-floating mb-2">
                                                        <input type="email" name="email" autofocus
                                                            class="form-control" id="email"
                                                            placeholder="User email" value="{{ $em }}">
                                                        <label for="email">User email</label>
                                                    </div>
                                                    <div class="form-floating mb-2">
                                                        <input type="text" name="password" autofocus
                                                            class="form-control" id="pw"
                                                            placeholder="User password" value="{{ $pa }}">
                                                        <label for="pw">User password</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                                    <button type="Submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <form action="/user/{{ $item->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button title="Hapus data" class="btn btn-danger show_confirm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-footer></x-footer>
