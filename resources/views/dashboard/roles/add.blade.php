<x-dashboard.layouts.master title="{{__('dashboard.add roles')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.add roles')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">{{__('dashboard.roles list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.add roles')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{route('admin.roles.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{__('dashboard.role name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="{{__('dashboard.role name')}}" >
                                    @error('name')
                                    <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong>{{__('dashboard.Permissions')}}:</strong>
                                        <div class="form-group row offset-1 mt-2">
                                            @foreach($permissions as $key => $value)
                                                <div class="form-check  col-md-2 mb-1 {{$key == 0 || $key % 5 == 0 ? 'offset-1':''}} ">
                                                    <label class="form-check-label mt-1">
                                                        <input type="checkbox" class="form-check-input" name="permission[]" value="{{$value->id}}">
                                                        {{__('roles_permissions.'.$value->name)}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @error('permission')
                                <span style="font-size: 14px;" class="alert alert-danger d-flex justify-content-center">{{$message}}</span>
                                @enderror
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{__('dashboard.submit')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-dashboard.layouts.master>
