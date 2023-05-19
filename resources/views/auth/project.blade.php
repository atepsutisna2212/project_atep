<x-header></x-header>
<div class="container-fluid px-4">
    <h1 class="my-4">{{ $title }}</h1>
    <div class="card">
        <div class="card-body">
            <form action="/filter-project" method="post">
                <div class="row">
                    <div class="col-2 d-flex align-items-center ">
                        <h3>Filter</h3>
                    </div>
                    @csrf
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Project name</label>
                            <input type="text" class="form-control" value="{{ session('project') }}" id="projectName"
                                name="project_name">
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="client" class="form-label">Client</label>
                        <select class="form-select" aria-label="Default select example" id="client" name="client">
                            <option value="">All client</option>
                            @foreach ($client as $item)
                                <option {{ session('client') == $item->client_id ? 'selected' : '' }}
                                    value="{{ $item->client_id }}">{{ $item->client_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" id="status" name="status">
                            <option value="">All status</option>
                            <option {{ session('status') == 'OPEN' ? 'selected' : '' }} value="OPEN">OPEN</option>
                            <option {{ session('status') == 'DOING' ? 'selected' : '' }} value="DOING">DOING</option>
                            <option {{ session('status') == 'DONE' ? 'selected' : '' }} value="DONE">DONE</option>
                        </select>
                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-around mt-3">
                        <button type="submit" class="btn btn-success">Search</button>
                        <a href="/project" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <form action="/delete-data" method="post">
            @csrf
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new">
                    New
                </button>
                <button type="submit" class="show_confirm ms-2 btn btn-danger">Delete</button>
            </div>
            <div class="card-body">
                <table id="tabel" class="table table-bordered border-dark">
                    <thead class="bg-info">
                        <tr>
                            <th><input class="form-check-input" type="checkbox" id="checkAll"></th>
                            <th>Action</th>
                            <th>Project name</th>
                            <th>Client</th>
                            <th>Project start</th>
                            <th>Project end</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox" value="{{ $item->project_id }}"
                                        name="project_id[]" id="check" required>
                                </td>
                                <td><button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $item->project_id }}">
                                        Edit
                                    </button></td>
                                <td>{{ $item->project_name }}</td>
                                <td>{{ $item->client->client_name }}</td>
                                <td>{{ formatDate($item->project_start) }}</td>
                                <td>{{ formatDate($item->project_end) }}</td>
                                <td>{{ $item->project_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="new" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">New project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/project" method="post">
                @csrf
                <div class="modal-body">
                    @if ($errors->any() && !old('id'))
                        @php
                            notifError($errors->all());
                            $project_name = old('project_name');
                            $client_id = old('client_id');
                            $project_start = old('project_start');
                            $project_end = old('project_end');
                            $project_status = old('project_status');
                        @endphp
                    @else
                        @php
                            $project_name = '';
                            $client_id = '';
                            $project_start = '';
                            $project_end = '';
                            $project_status = '';
                        @endphp
                    @endif
                    <div class="form-floating mb-2">
                        <input type="text" name="project_name" autofocus class="form-control" id="project_name"
                            placeholder="Project name" value="{{ $project_name }}">
                        <label for="project_name">Project name</label>
                    </div>
                    <select class="form-select mb-2" name="client_id"required>
                        <option value="" selected disabled hidden>-Client-</option>
                        @foreach ($client as $item)
                            <option {{ $item->client_id == $client_id ? 'selected' : '' }}
                                value="{{ $item->client_id }}">{{ $item->client_name }}</option>
                        @endforeach
                    </select>
                    <div class="form-floating mb-2">
                        <input type="date" name="project_start" required class="form-control" id="project_start"
                            placeholder="Project start" value="{{ $project_start }}">
                        <label for="project_start">Project start</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="date" name="project_end" required class="form-control" id="project_end"
                            placeholder="Project end" value="{{ $project_end }}">
                        <label for="project_end">Project end</label>
                    </div>
                    <select class="form-select" name="project_status"required>
                        <option value="" selected disabled hidden>-Status-</option>
                        <option {{ 'OPEN' == $project_status ? 'selected' : '' }} value="OPEN">OPEN</option>
                        <option {{ 'DOING' == $project_status ? 'selected' : '' }} value="DOING">DOING</option>
                        <option {{ 'DONE' == $project_status ? 'selected' : '' }} value="DONE">DONE</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="Submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- edit --}}
@foreach ($data as $item)
    {{-- edit --}}
    <div class="modal fade" id="edit{{ $item->project_id }}" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/project/{{ $item->project_id }}" method="post">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any() && old('id') == $item->project_id)
                            @php
                                notifError($errors->all());
                                $project_name = old('project_name');
                                $client_id = old('client_id');
                                $project_start = old('project_start');
                                $project_end = old('project_end');
                                $project_status = old('project_status');
                            @endphp
                        @else
                            @php
                                $project_name = $item->project_name;
                                $client_id = $item->client_id;
                                $project_start = $item->project_start;
                                $project_end = $item->project_end;
                                $project_status = $item->project_status;
                            @endphp
                        @endif
                        <div class="form-floating mb-2">
                            <input type="text" name="project_name" autofocus class="form-control"
                                id="project_name" placeholder="Project name" value="{{ $project_name }}">
                            <label for="project_name">Project name</label>
                        </div>
                        <input type="hidden" name="id" value="{{ $item->project_id }}">
                        <select class="form-select mb-2" name="client_id"required>
                            <option value="" selected disabled hidden>-Client-</option>
                            @foreach ($client as $x)
                                <option {{ $client_id == $x->client_id ? 'selected' : '' }}
                                    value="{{ $x->client_id }}">
                                    {{ $x->client_name }}</option>
                            @endforeach
                        </select>
                        <div class="form-floating mb-2">
                            <input type="date" name="project_start" autofocus required class="form-control"
                                id="project_start" placeholder="Project start" value="{{ $project_start }}">
                            <label for="project_start">Project start</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="date" name="project_end" autofocus required class="form-control"
                                id="project_end" placeholder="Project end" value="{{ $project_end }}">
                            <label for="project_end">Project end</label>
                        </div>
                        <select class="form-select" name="project_status"required>
                            <option value="" selected disabled hidden>-Status-</option>
                            <option {{ $project_status == 'OPEN' ? 'selected' : '' }} value="OPEN">OPEN
                            </option>
                            <option {{ $project_status == 'DOING' ? 'selected' : '' }} value="DOING">DOING
                            </option>
                            <option {{ $project_status == 'DONE' ? 'selected' : '' }} value="DONE">DONE
                            </option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="Submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<x-footer></x-footer>
