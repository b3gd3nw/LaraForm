@extends('layouts.admin_layout')

@section('title', 'All Members')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Members</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
                @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 5%">
                            Photo
                        </th>
                        <th style="width: 20%">
                            Name
                        </th>
                        <th>
                            Country
                        </th>
                        <th style="width: 20%" class="text-center">
                            Email
                        </th>
                        <th style="width: 30%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>
                                    {{ $member['id'] }}
                                </td>
                                <td>
                                    photo
                                </td>
                                <td>
                                    {{ $member['firstname'] . ' ' . $member['lastname'] }}
                                </td>
                                <td class="project_progress">
                                  {{ $member['country'] }}
                                </td>
                                <td class="project-state">
                                    <a href="mailto:{{ $member['email'] }}">{{ $member['email'] }}</a>
                                </td>
                                <td class="project-actions text-right">
                                    <div class="row justify-content-end">
                                        <div class="col-sm-4 text-center">
                                            <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                        </div>
                                        <div class="col-sm-4 text-center">
                                            <form action="{{ route('member.destroy', $member['id'])  }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Show / Hide
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>

@endsection
