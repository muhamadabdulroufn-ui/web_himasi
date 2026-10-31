@extends('layouts.admin')
@section('title', 'Users')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit User</h1>
    </div>
    <a href="{{ route('users.index')}}" class="btn btn-icon icon-left btn-primary mb-4"><i class="fas fa-arrow-left"></i>Kembali</a>
      <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('users.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          <div class="card-body">          
            <div class="row">
              <div class="form-group col-md-6">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
              </div>
              <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Password</label>
                <input type="password" name="password" class="form-control" >
              </div>
              <div class="form-group col-md-6">
                <label>Role</label>
                <select class="form-control" name="role" id="exampleFormControlSelect1">
                  <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="pembina" {{ $data->role == 'pembina' ? 'selected' : '' }}>Pembina</option>
                  <option value="pengurus" {{ $data->role == 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                </select>
              </div>
            </div> 
            <button type="submit" class="btn btn-icon icon-left btn-primary">
              Simpan
          </button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection