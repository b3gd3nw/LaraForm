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
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                        <th style="width: 50%">
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
                                    @if ( $member['photo'] !== null )
                                        <img class="user_photo img-thumbnail"
                                             src="/storage/{{ $member['photo'] }}"
                                             alt="user_photo">
                                    @else
                                        <img class="user_photo img-thumbnail"
                                             src="https://randomuser.me/api/portraits/lego/6.jpg"
                                             alt="user_photo">
                                    @endif
                                </td>
                                <td>
                                    {{ $member['firstname'] . ' ' . $member['lastname'] }}
                                </td>
                                <td class="project_progress">
                                  {{ $member['country']['name'] }}
                                </td>
                                <td class="project-state">
                                    <a href="mailto:{{ $member['email'] }}">{{ $member['email'] }}</a>
                                </td>
                                <td class="project-actions text-right">
                                    <div class="row justify-content-end">
                                        <div class="col-sm-4 text-center mx-auto">
                                            <!-- Button trigger modal 1 -->
                                            <button data-path="{{ route('member.edit',$member['id']) }}"
                                                    class="btn btn-primary btn-sm load-ajax-modal"
                                                    role="button"
                                                    data-toggle="modal" data-target="#dynamic-modal{{ $member['id'] }}"
                                                    id="{{ $member['id'] }}">
                                                <i class="fas fa-edit">
                                                </i>
                                                <span class="glyphicon glyphicon-eye-open"></span> Edit Member
                                            </button>
                                            <!-- Modal 1 -->
                                            <div class="modal fade" id="dynamic-modal{{ $member['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel{{ $member['id']}}">Edit info member #{{ $member['id']}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body{{ $member['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                            <form action="{{ route('member.show', $member['id'])  }}" method="GET">
                                                @csrf
                                                @if($member['hide'] === 0)
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-eye-slash">
                                                        </i>
                                                        Hide
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye">
                                                        </i>
                                                        Show
                                                    </button>
                                                @endif
                                            </form>
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
