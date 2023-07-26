@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Mail</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/mail/send" class="mb-3">
        <input type="hidden" name="status" value="Sent">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Contact</label>
            <select class="form-select" name="contactId">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {!! $auth->name !== $user->name ? $user->name : '-- Pilih User --' !!}
                    </option>
                @endforeach
            </select>
        </div>

        <h3 for="pesan" class="form-label">Pesan</h3>
        <div class="mb-3">
            @error('pesan')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <textarea name="pesan" id="pesan" cols="90" rows="10"></textarea>
        </div>
        <div>
            <button type="submit" class="btn-lg btn-success m-4"><b>Send Mail</b></button>
            <a class="btn btn-danger" href="/dashboard/mail/" style="text-decoration: none;">Kembali</a>
        </div>
    </form>
</div>

@endsection