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

<div class="table-responsive col-lg-8">
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">Balasan</th>
                <th scope="col">Waktu</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mails as $mail)
            @if(!auth()->user()->is_admin)
            <tr>
                <td>{{ $mail->pengirim->name }}</td>
                <td>{{ $mail->created_at }}</td>
                <td>{{ $mail->status }}</td>
                <td>
                    <form action="/dashboard/mail/detail" method="post" class="d-inline">
                        @method('put')
                        @csrf
                        <input type="hidden" name="status" value="Read">
                        <input type="hidden" name="userId" value="{{ $mail->user_id }}">
                        <button class="badge bg-primary border-0"><span data-feather="mail"></button>
                    </form>
                </td>
            </tr>
            @else
            @unless(!$mail->pengirim->name === auth()->user()->name)
            <tr>
                <td>{{ $mail->pengirim->name }}</td>
                <td>{{ $mail->created_at }}</td>
                <td>{{ $mail->status }}</td>
                <td>
                    <form action="/dashboard/mail/detail" method="post" class="d-inline">
                        @method('put')
                        @csrf
                        <input type="hidden" name="status" value="Read">
                        <input type="hidden" name="userId" value="{{ $mail->pengirim->id }}">
                        <button class="badge bg-primary border-0"><span data-feather="mail"></button>
                    </form>
                </td>
            </tr>
            @endunless
            @endif
            @endforeach
            @foreach ($adminMail as $mail)
            <tr>
                @if ($mail->pengirim->name !== Auth::user()->name)
                    <td>{{ $mail->pengirim->name }}</td>
                    <td>{{ $mail->created_at }}</td>
                    <td>{{ $mail->status }}</td>
                    <td>
                        <form action="/dashboard/mail/detail" method="post" class="d-inline">
                            @method('put')
                            @csrf
                            <input type="hidden" name="status" value="Read">
                            <input type="hidden" name="userId" value="{{ $mail->user_id }}">
                            <button class="badge bg-primary border-0"><span data-feather="mail"></span></button>
                        </form>
                    </td>
                @endif
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

@endsection