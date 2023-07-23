@extends('layouts.main')

@section('container')
<div class="container mb-5">
    <div class="bg-primary mb-3">
        <div class="text-center p-2" style="border: solid blue 1px;">
            <h1 class="display-6 fw-bolder text-white mb-2">About us</h1>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <div class="col">
        <div class="card shadow-sm p-2">
            <h4 class="text-center fw-bold bg-primary p-2 text-white">FullStack Developer</h4>
            <div class="d-flex justify-content-center">
                <img src="img/aldi.jpg" alt="{{ $name }}" width="200" height="200" class="img-thumbnail">
            </div>
            <div class="card-body d-flex justify-content-center">
            <table class="table">
                <tbody>
                    <tr>
                        <td><b>Nama</b></td>
                        <td>:</td>
                        <td> Aldi Ramdani</td>
                    </tr>
                    <tr>
                        <td><b>NIM</b></td>
                        <td>:</td>
                        <td> 11210334</td>
                    </tr>
                    <tr>
                        <td><b>Jurusan</b></td>
                        <td>:</td>
                        <td> Teknik Informatika</td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-2">
            <h4 class="text-center fw-bold bg-primary p-2 text-white">UI Designer</h4>
            <div class="d-flex justify-content-center">
                <img src="img/hilda.jpg" alt="hilda" width="200" height="200" class="img-thumbnail">
            </div>
            <div class="card-body d-flex justify-content-center">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><b>Nama</b></td>
                            <td>:</td>
                            <td> Hilda Amelia</td>
                        </tr>
                        <tr>
                            <td><b>NIM</b></td>
                            <td>:</td>
                            <td> 11210450</td>
                        </tr>
                        <tr>
                            <td><b>Jurusan</b></td>
                            <td>:</td>
                            <td> Teknik Informatika</td>
                        </tr>
                    </tbody>
                </table>
              </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-2">
            <h4 class="text-center fw-bold bg-primary p-2 text-white">UX Designer</h4>
            <div class="d-flex justify-content-center">
                <img src="img/ila.jpg" alt"ila" width="200" height="200" class="img-thumbnail">
            </div>
            <div class="card-body d-flex justify-content-center">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><b>Nama</b></td>
                            <td>:</td>
                            <td> Ila Siti Latifah</td>
                        </tr>
                        <tr>
                            <td><b>NIM</b></td>
                            <td>:</td>
                            <td> 11210331</td>
                        </tr>
                        <tr>
                            <td><b>Jurusan</b></td>
                            <td>:</td>
                            <td> Teknik Informatika</td>
                        </tr>
                    </tbody>
                </table>
              </div>
        </div>
      </div>
  </div>
</div>
@endsection