@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mail Box</h1>
</div>

<a href="/dashboard/mail/create" class="btn btn-primary mb-3">Create new mail</a>

@if(session()->has('success'))
<div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">Pengirim</th>
                <th scope="col">Waktu</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        @php
            $pengirimNames = [];
        @endphp

        @foreach ($mails as $mail)
            @if (!in_array($mail->pengirim->name, $pengirimNames))
                @if ($mail->pengirim->name !== Auth::user()->name)
                @php
                    $pengirimNames[] = $mail->pengirim->name;
                @endphp
                <tr>
                    <td>{{ $mail->pengirim->name }}</td>
                    <td>{{ $mail->created_at }}</td>
                    <td>
                        <form action="/dashboard/mail/detail/{{ $chatId[0]->chat_id }}" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="chatId" value="{{ $chatId[0]->chat_id }}">
                            <button class="badge bg-primary border-0"><span data-feather="mail"></span></button>
                        </form>
                    </td>
                </tr>
                @endif
            @endif
        @endforeach
        </tbody>
    </table>
</div>

@endsection
