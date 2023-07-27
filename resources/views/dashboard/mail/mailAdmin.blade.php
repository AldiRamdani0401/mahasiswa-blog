@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mail Box</h1>
</div>

<a href="/dashboard/mail/create" class="btn btn-primary mb-2">Create new mail</a>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive mt-3" style="border: solid black 1px ;max-height: 400px; overflow-y: auto;">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pengirim</th>
                <th scope="col">Pesan</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @if (Auth::user()->is_admin)
            @foreach ($pengirim as $mail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mail->pengirim->name }}</td>
                    <td>{{ $mail->pesan }}</td>
                    <td>{{ $mail->status }}</td>
                    <td>
                        <form action="/dashboard/mail/delete" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <input type="hidden" name="id" value="{{ $mail->id }}">
                            <input type="hidden" name="contactId" value="{{ $mail->contact_id }}">
                            <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
                                <span data-feather="x-circle"></span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5"><h1>No incoming mail</h1></td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
    <main class="form-signin mt-5 text-center">
    <form action="/dashboard/mail/send" method="post">
    @csrf
    @foreach ($pengirim as $mail)
        <input type="hidden" name="contactId" value="{{ $mail->contact_id }}">
        <input type="hidden" name="status" value="Reply">
        <input type="hidden" name="recipientId" value="{{ $mail->pengirim->id }}">
    @endforeach
    <div class="form-floating mb-3">
        <textarea name="pesan" class="form-control @error('pesan') is-invalid @enderror" id="pesan" autofocus></textarea>
        @error('pesan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit"><b>Send Mail</b></button>
    </form>
    <a href="/dashboard/mail" class="btn btn-danger mt-4">Kembali</a>
    </main>
@endsection