@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Account Settings</h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-5">
      <main class="form-editAccount text-center">
        <div class="d-flex justify-content-center">
          @if(session()->has('success'))
          <div class="alert alert-success col-lg-8" role="alert">
            {{ session('success') }}
          </div>
          @endif
          @if (session()->has('updateError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('updateError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        </div>
            <h1 class="h3 mb-3 fw-normal text-center">Change Password</h1>
            <form action="/dashboard/account-settings/changePassword" method="post" class="text-center">
              @method('put')
              @csrf
              <input type="hidden" name="id" id="id" placeholder="name" required value="{{ $user->id }}">
              <div class="form-floating">
                <input type="password" name="newPassword" class="form-control mb-2 rounded-bottom @error('password') is-invalid @enderror" id="newPassword" placeholder="New Password" required>
                <label for="newPasword">New Password</label>
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="newConfPassword" class="form-control mb-2 rounded-bottom @error('password') is-invalid @enderror" id="newConfPassword" placeholder="confirm Password" required>
                <label for="newConfPassword">Confirm Password</label>
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control mb-2 rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <button class="w-50 btn btn-success mt-3" type="submit">Save</button>
            </form>
        </main>
    </div>
</div>

@endsection