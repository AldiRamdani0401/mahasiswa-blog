@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Mail</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/mail/send" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Contact</label>
            <select class="form-select" name="receiverId" id="receiverId">
                @foreach ($users as $user)
                    @if (Auth::user()->name !== $user->name)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <h3 for="message" class="form-label">message</h3>
        <div class="mb-3">
            @error('message')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <textarea name="message" id="message" cols="90" rows="10"></textarea>
        </div>
        <div>
            <input type="hidden" name="chatId" value="">
            <input type="hidden" name="senderId" value="{{ Auth::user()->id }}">
            <button type="submit" class="btn-lg btn-success m-4"><b>Send</b></button>
            <a class="btn btn-danger" href="/dashboard/mail/" style="text-decoration: none;">Kembali</a>
        </div>
    </form>
</div>

<script>
    // Mendapatkan referensi ke elemen <select> dan input <hidden>
    const receiverSelect = document.getElementById('receiverId');
    const senderIdinput = document.querySelector('input[name="senderId"]');
    const chatIdInput = document.querySelector('input[name="chatId"]');

    // Fungsi untuk menghitung nilai chatId dan mengatur receiverId
    function updateChatIdValue() {
        // Mendapatkan nilai dari opsi yang dipilih
        const selectedUserId = receiverSelect.value;

        // Mendapatkan nilai chatId sebelumnya dari input hidden
        const senderId = parseInt(senderIdinput.value);

        const newChatIdValue = senderId + parseInt(selectedUserId);

        // Mengatur nilai chatId pada input hidden
        chatIdInput.value = newChatIdValue;

        // Mengatur nilai selectedReceiverId pada input hidden
    }

    // Panggil fungsi updateChatIdValue() ketika opsi diubah
    receiverSelect.addEventListener('change', updateChatIdValue);

    // Panggil fungsi updateChatIdValue() untuk menginisialisasi nilai chatId saat halaman dimuat
    updateChatIdValue();
</script>

@endsection
