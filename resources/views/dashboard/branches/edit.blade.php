@php use App\Models\DeliveryType; @endphp
<x-dashboard.layouts.master title="{{__('dashboard.edit branch')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.edit branch')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.branches.index')}}">{{__('dashboard.branches list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="content-body">
                <!-- Form wizard with step validation section start -->
                <section id="validation">
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{__('dashboard.edit branch')}}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="steps-validation wizard-circle" method="POST" action="{{route('admin.branches.update',$branch->id)}}" enctype="multipart/form-data" id="branchForm">
                                            @csrf
                                            @method('PUT')
                                            <!-- Step 1 -->
                                            <h6><i class="step-icon feather icon-home"></i> {{__('dashboard.edit branch')}}</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first-name-icon">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="first-name-icon" value="{{old('name_ar',$branch->name_ar)}}" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}">
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
                                                                <input type="text" id="first-name-icon" class="form-control" value="{{old('name_en',$branch->name_en)}}" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-grid"></i>
                                                                </div>
                                                            </div>
                                                            @error('name_en')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="password-icon">{{__('dashboard.table phone')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text"  class="form-control" value="{{old('phone',$branch->phone)}}" name="phone" placeholder="{{__('dashboard.table phone')}}">
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
                                                                <input type="text" id="address" class="form-control" value="{{old('address',$branch->address)}}" name="address" placeholder="{{__('dashboard.table address')}}">
                                                                <input type="hidden" id="latitude" value="{{old($branch->latitude)}}" name="latitude" />
                                                                <input type="hidden"  id="longitude" value="{{old($branch->longitude)}}" name="longitude" />
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                            @error('address')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
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
                                                                            <option value="{{$vendor->id}}" {{$vendor->id == $branch->vendor_id?'selected':''}}>{{$vendor->name}}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <input type="hidden" name="vendor_id" value="{{$vendors->id}}">
                                                    @endif
                                                </div>
                                                <div class="row">

                                                    <div class="form-group col-6">
                                                        <fieldset class="checkbox">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" name="active" {{$branch->active == 1?'checked':''}}>
                                                                <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                                <span class="">{{__('dashboard.table status')}}</span>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!-- Step 2 -->
                                            <h6><i class="step-icon feather icon-user-plus"></i> {{__('dashboard.add branch manager')}}</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="password-icon">{{__('dashboard.table name')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text"  class="form-control" value="{{old('name',$branch->user->name)}}" name="name" placeholder="{{__('dashboard.table name')}}">
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
                                                                <input type="email"  class="form-control" value="{{old('email',$branch->user->email)}}" name="email" placeholder="{{__('dashboard.table email')}}">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-envelope"></i>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="password-icon">{{__('dashboard.table phone')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text"  class="form-control" value="{{old('userPhone',$branch->user->phone)}}" name="userPhone" placeholder="{{__('dashboard.table phone')}}">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            @error('userPhone')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="password-icon">{{__('dashboard.table address')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text"  class="form-control" id="user-address" value="{{old('user_address',$branch->user->address)}}" name="user_address" placeholder="{{__('dashboard.table address')}}">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-map-marker"></i>
                                                                </div>
                                                            </div>
                                                            @error('user_address')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!-- Step 3 -->
                                            <h6><i class="step-icon feather icon-truck"></i> {{__('dashboard.delivery type')}}</h6>
                                            <fieldset>
                                                <section class="multiple-select2">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">{{__('dashboard.choose delivery type')}}</h4>
                                                                </div>
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="form-group col-6">
                                                                                <select class="select2 form-control delivery-select" name="deliveryTypes[]" multiple="multiple">
                                                                                    <optgroup label="{{__('dashboard.delivery type')}}">
                                                                                        @foreach(DeliveryType::all() as $type)
                                                                                            <option value="{{$type->id}}" id="{{$type->type}}" {{in_array($type->id,$branch->deliveryTypes->pluck('id')->toArray())?'selected':''}}>{{$type->type}}</option>
                                                                                        @endforeach
                                                                                    </optgroup>
                                                                                </select>
                                                                                @error('deliveryTypes')
                                                                                <span class="text text-danger">{{$message}}</span>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group col-6">
                                                                                <div class="position-relative has-icon-left">
                                                                                    <input type="text"  class="form-control" value="{{old('range_of_delivery_price',$branch->range_of_delivery_price)}}" name="range_of_delivery_price" minlength="5" maxlength="20" placeholder="{{__('dashboard.range of delivery price')}}">
                                                                                    <div class="form-control-position">
                                                                                        <i class="fa fa-usd"></i>
                                                                                    </div>
                                                                                </div>
                                                                                @error('range_of_delivery_price')
                                                                                <span class="text text-danger">{{$message}}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
{{--                                                <button type="submit">submit</button>--}}
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with step validation section end -->
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
        <script>
            $('[href="#finish"]').click(function() {
                $('#branchForm').submit();
            })
        </script>


    @endsection
</x-dashboard.layouts.master>
