<x-dashboard.layouts.master title="{{__('dashboard.add service')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.add service')}}">
            </x-dashboard.layouts.breadcrumb>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.add service')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{route('admin.services.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                            <input type="text" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}" value="{{old('name_ar')}}">
                                            @error('name_ar')
                                            <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                            <input type="text" class="form-control" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}" value="{{old('name_en')}}">
                                            @error('name_en')
                                            <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                            <input type="text" class="form-control" name="name_en" placeholder="{{__('dashboard.table description').__('dashboard.in arabic')}}" value="{{old('description_ar')}}">
                                            @error('name_en')
                                            <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                            <input type="text" class="form-control" name="name_en" placeholder="{{__('dashboard.table description').__('dashboard.in english')}}" value="{{old('description_en')}}">
                                            @error('name_en')
                                            <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">{{__('dashboard.submit')}}</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.service list')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h1>123456</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layouts.master>
