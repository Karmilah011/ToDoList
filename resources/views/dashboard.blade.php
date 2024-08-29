@extends('template.master')
@section('content')
    <p>Years : {{ date('Y') }}</p>
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
              <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                  <div class="card-body">
                    <h5 class="card-title text-primary">Summary Task</h5>
                    <p class="mb-4">
                      You have completed <span class="fw-bold">{{ $total_true_tasks }}</span> tasks. There are still <span class="fw-bold">{{ $total_false_tasks }}</span> tasks To Do.
                    </p>

                    <a href="{{ route('task.index') }}" class="btn btn-sm btn-outline-primary">View Tasks</a>
                  </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                  <div class="card-body pb-0 px-0 px-md-4">
                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection
