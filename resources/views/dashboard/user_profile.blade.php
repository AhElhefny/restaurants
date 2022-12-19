<x-dashboard.layouts.master title="{{__('dashboard.app notifications')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <h4 class="font-weight-bold py-3 mb-4">
                <span class="text-muted font-weight-light">{{__('dashboard.account settings')}}/</span>  <span id="var">{{__('dashboard.personal information')}}</span>
            </h4>
            <div class="card-content">

                <div class="nav nav-pills  mb-4 ml-5 d-inline-flex">
                    <a class="nav-item nav-link active mr-2" style="font-size: large" data-toggle="tab" id="personal-link" href="#personal"><i class="feather icon-user me-1">  {{__('dashboard.personal information')}}</i></a>
                    <a class="nav-item nav-link" style="font-size: large" data-toggle="tab" id="bank-link" href="#bank-account"><i class="feather icon-credit-card">  {{__('dashboard.bank-account')}}</i></a>
                </div>
            </div>

            <div class="tab-content">
                <img class="rounded-circle img-border box-shadow-1 profile-img-container" style="height: 150px; width: 150px;position: absolute;left: 620px; top: 300px;z-index: 999; border: 4px solid #ddd;" src="{{$user->image}}">
                <div role="tabpanel" class="tab-pane active" id="personal" aria-labelledby="home-tab-end" aria-expanded="false">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('dashboard.personal information')}}</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-vertical" method="POST" action="{{route('admin.category.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-icon">{{__('dashboard.table image')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="file" id="email-id-icon" class="form-control" name="image">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-image"></i>
                                                            </div>
                                                        </div>
                                                        @error('image')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="first-name-icon" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-grid"></i>
                                                            </div>
                                                        </div>
                                                        @error('name_ar')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="first-name-icon" class="form-control" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-grid"></i>
                                                            </div>
                                                        </div>
                                                        @error('name_en')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-icon">{{__('dashboard.table description'). __('dashboard.in arabic')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="contact-info-icon" class="form-control" name="description_ar" placeholder="{{__('dashboard.table description'). __('dashboard.in arabic')}}"/>
                                                            <div class="form-control-position">
                                                                <i class="fa fa-pencil"></i>
                                                            </div>
                                                        </div>
                                                        @error('description_ar')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-icon">{{__('dashboard.table description'). __('dashboard.in english')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="password-icon" class="form-control" name="description_en" placeholder="{{__('dashboard.table description'). __('dashboard.in english')}}">
                                                            <div class="form-control-position">
                                                                <i class="fa fa-pencil"></i>
                                                            </div>
                                                        </div>
                                                        @error('description_en')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox" name="active">
                                                            <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                            <span class="">{{__('dashboard.table status')}}</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{__('dashboard.submit')}}</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('dashboard.reset')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="bank-account" aria-labelledby="profile-tab-end" aria-expanded="false" >
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('dashboard.bank-account')}}</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-vertical" method="POST" action="{{route('admin.category.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-icon">{{__('dashboard.table image')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="file" id="email-id-icon" class="form-control" name="image">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-image"></i>
                                                            </div>
                                                        </div>
                                                        @error('image')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="first-name-icon" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-grid"></i>
                                                            </div>
                                                        </div>
                                                        @error('name_ar')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="first-name-icon" class="form-control" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-grid"></i>
                                                            </div>
                                                        </div>
                                                        @error('name_en')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-icon">{{__('dashboard.table description'). __('dashboard.in arabic')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="contact-info-icon" class="form-control" name="description_ar" placeholder="{{__('dashboard.table description'). __('dashboard.in arabic')}}"/>
                                                            <div class="form-control-position">
                                                                <i class="fa fa-pencil"></i>
                                                            </div>
                                                        </div>
                                                        @error('description_ar')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-icon">{{__('dashboard.table description'). __('dashboard.in english')}}</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="password-icon" class="form-control" name="description_en" placeholder="{{__('dashboard.table description'). __('dashboard.in english')}}">
                                                            <div class="form-control-position">
                                                                <i class="fa fa-pencil"></i>
                                                            </div>
                                                        </div>
                                                        @error('description_en')
                                                        <span class="text text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox" name="active">
                                                            <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                            <span class="">{{__('dashboard.table status')}}</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{__('dashboard.submit')}}</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('dashboard.reset')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            $(document).ready(function (){
               $('#personal-link').on('click',function (){
                   $('#var').html('');
                   $('#personal').show();
                   $('#bank-account').hide();
                   $('#var').html('{{__('dashboard.personal information')}}');
               }) ;
               $('#bank-link').on('click',function (){
                   $('#var').html('');
                   $('#personal').hide();
                   $('#bank-account').show();
                   $('#var').html('{{__('dashboard.bank-account')}}');
               }) ;
            });
        </script>
    @endsection
</x-dashboard.layouts.master>
