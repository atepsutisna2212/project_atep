<x-header></x-header>
<div class="container-fluid px-4">
    <h1 class="my-4">{{ $title }}</h1>
    <div class="row">
        <div class="col-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body text-center">Project</div>
                <h3 class="text-center">{{ $project }}</h3>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link text-decoration-none" href="/project">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-warning text-dark mb-4">
                <div class="card-body text-center">Client</div>
                <h3 class="text-center">{{ $client }}</h3>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link text-decoration-none" href="/client">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body text-center">User</div>
                <h3 class="text-center">{{ $user }}</h3>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link text-decoration-none" href="user">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-footer></x-footer>
