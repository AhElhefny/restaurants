<x-dashboard.layouts.master title="{{__('dashboard.add branch')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.add branch')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.branches.index')}}">{{__('dashboard.branches list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.add branch')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method="POST" action="{{route('admin.branches.store')}}" enctype="multipart/form-data">
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
                                            @if(auth()->user()->type == App\Models\User::ADMIN)
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">{{__('dashboard.vendors')}}</label>
                                                        <select name="vendor_id" class="select2 form-control">
                                                            <optgroup label="{{__('dashboard.choose vendor')}}">
                                                                @foreach($vendors as $vendor)
                                                                    <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <input type="hidden" name="vendor_id" value="{{$vendors->id}}">
                                            @endif
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-icon">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="text" id="first-name-icon" value="{{old('name_ar')}}" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-grid"></i>
                                                        </div>
                                                    </div>
                                                    @error('name_ar')
                                                    <span class="text text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-icon">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="text" id="first-name-icon" class="form-control" value="{{old('name_en')}}" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-grid"></i>
                                                        </div>
                                                    </div>
                                                    @error('name_en')
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
                                                    <label for="password-icon">{{__('dashboard.range of delivery price')}}</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="text"  class="form-control" value="{{old('range_of_delivery_price')}}" name="range_of_delivery_price" placeholder="From:0 To:max">
                                                        <div class="form-control-position">
                                                            <i class="fa fa-usb"></i>
                                                        </div>
                                                    </div>
                                                    @error('range_of_delivery_price')
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
                                                <input type="hidden" name="latitude" id="latitude" value="" >
                                                <input type="hidden" name="longitude" id="longitude" value="" >
                                            </div>
                                            <div class="form-group col-6">
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
                                            <div class="card-header col-12 mb-4">
                                                <h4 class="card-title">{{__('dashboard.add branch manager')}}</h4>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="password-icon">{{__('dashboard.table name')}}</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="text"  class="form-control" value="{{old('name')}}" name="name" placeholder="{{__('dashboard.table name')}}">
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
                                                    <label for="password-icon">{{__('dashboard.table address')}}</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="text"  class="form-control" id="user-address" value="{{old('user_address')}}" name="user_address" placeholder="{{__('dashboard.table address')}}">
                                                        <div class="form-control-position">
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
                                                    @error('user_address')
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
                var input = document.getElementById('user-address');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    // place variable will have all the information you are looking for.
                });
            }
        </script>
        <script>
            google.maps.event.addDomListener(window, 'load', initialize);
            function initialize() {
                var input = document.getElementById('address');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    // place variable will have all the information you are looking for.

                    document.getElementById("latitude").value = place.geometry['location'].lat();
                    document.getElementById("longitude").value = place.geometry['location'].lng();
                });
            }
        </script>
    @endsection
</x-dashboard.layouts.master>
