<x-dashboard.layouts.master title="{{__('dashboard.add user')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.add user')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.customers.index')}}">{{__('dashboard.users list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.add user')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{route('admin.customers.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-icon">{{__('dashboard.table name')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="first-name-icon" value="{{old('name')}}" class="form-control" name="name" placeholder="{{__('dashboard.table name')}}">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-grid"></i>
                                                    </div>
                                                </div>
                                                @error('name')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table address')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="address" class="form-control" value="{{old('address')}}" name="address" placeholder="{{__('dashboard.table address')}}">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                </div>
                                                @error('address')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table phone')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text"  class="form-control" value="{{old('phone')}}" name="phone" placeholder="{{__('dashboard.table phone')}}">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                </div>
                                                @error('phone')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table email')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="email"  class="form-control" value="{{old('email')}}" name="email" placeholder="{{__('dashboard.table email')}}">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-envelope"></i>
                                                    </div>
                                                </div>
                                                @error('email')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table password')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="password"  class="form-control" name="password" placeholder="{{__('dashboard.table password')}}">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </div>
                                                @error('password')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table confirm password')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="password"  class="form-control" name="password_confirmation" placeholder="{{__('dashboard.table confirm password')}}">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
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
    @section('script')
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyDrWqGIyXBP98tkCX9jSRrtzCpVJ-jI6ck&libraries=places"></script>

        <script>
            google.maps.event.addDomListener(window, 'load', initialize);
            function initialize() {
                var input = document.getElementById('address');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    // place variable will have all the information you are looking for.
                });
            }
        </script>
    @endsection
</x-dashboard.layouts.master>
