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
                <th scope="col">Chat</th>
                <th scope="col">Waktu</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @php
            $displayedNames = [];
            @endphp

            @foreach ($mails as $mail)
                @if ($mail->pengirim !== Auth::user()->name && !in_array($mail->pengirim, $displayedNames))
                    @php
                        $displayedNames[] = $mail->pengirim;
                    @endphp
                    <tr>
                        <td>{{ $mail->pengirim }}</td>
                        <td>{{ $mail->created_at }}</td>
                        <td>
                            <form action="/dashboard/mail/detail/{{ $mail->chat_id }}" method="post" class="d-inline">
                                @csrf
                                <input type="hidden" name="chatId" value="{{ $mail->chat_id }}">
                                <button class="badge bg-primary border-0"><span data-feather="mail"></span></button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
            @foreach ($mails as $mail)
                @if ($mail->penerima !== Auth::user()->name && !in_array($mail->penerima, $displayedNames))
                    @php
                        $displayedNames[] = $mail->penerima;
                    @endphp
                    <tr>
                        <td>{{ $mail->penerima }}</td>
                        <td>{{ $mail->created_at }}</td>
                        <td>
                            <form action="/dashboard/mail/detail/{{ $mail->chat_id }}" method="post" class="d-inline">
                                @csrf
                                <input type="hidden" name="chatId" value="{{ $mail->chat_id }}">
                                <button class="badge bg-primary border-0"><span data-feather="mail"></span></button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection
