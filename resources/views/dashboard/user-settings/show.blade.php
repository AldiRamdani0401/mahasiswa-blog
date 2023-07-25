@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">User Settings</h1>
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
            <h1 class="h3 mb-3 fw-normal text-center">Edit User</h1>
            <form action="/dashboard/user-settings/update" method="post" class="text-center">
              @method('put')
              @csrf
              <input type="hidden" name="id" id="id" placeholder="name" required value="{{ $user->id }}">
              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top mb-2 @error('name') is-invalid @enderror" id="name" placeholder="name" required value="{{ $user->name }}">
                <label for="name">Name</label>
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="text" name="username" class="form-control mb-2 @error('username') is-invalid @enderror" id="username" placeholder="username" required value="{{ $user->username  }}">
                <label for="username">Username</label>
                @error('username')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="email" name="email" class="form-control mb-2 @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ $user->email }}">
                <label for="email">Email address</label>
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <button class="w-50 btn btn-success mt-3" type="submit">Save</button>
            </form>
            <div class="text-center">
              <a class="btn btn-warning mt-3" href="/dashboard/user-settings">Kembali</a>
              <a class="btn btn-primary mt-3" href="/dashboard/account-settings/change-password/change">Change Password</a>
              <a class="btn btn-danger mt-3" href="/dashboard/user-settings">Delete</a>
            </div>
        </main>
    </div>
</div>

@endsection