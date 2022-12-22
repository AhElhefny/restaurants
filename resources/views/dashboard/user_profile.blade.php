<x-dashboard.layouts.master title="{{__('dashboard.account settings')}}">
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
                <div role="tabpanel" class="tab-pane active" id="personal" aria-labelledby="home-tab-end" aria-expanded="false">
                    <div class="row">
                        <div class="col-4 mt-3">
                            <div class="card">
                                <div class="card-header mb-2">
                                    <h4 class="card-title">{{__('dashboard.personal information')}}</h4>
                                </div>
                            </div>
                            <div class="card">
                                <div class="text-center mt-1 mb-2">
                                    <img class="rounded-circle img-border box-shadow-1 profile-img-container" style="height: 150px; width: 150px;border: 4px solid #ddd;" src="{{$user->image}}">
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content">

                                    <div class="card-body">
                                        <div class="mt-4" >
                                            <p class="mb-3"><span class="font-weight-bold"><i class="fa fa-pencil"></i> {{__('dashboard.table name')}} :</span><span class="float-right">{{$user->name}}</span></p>
                                            <p class="mb-3"><span class="font-weight-bold"><i class="feather icon-mail"></i> {{__('dashboard.table email')}} :</span><span class="float-right">{{$user->email}}</span></p>
                                            <p class="mb-3"><span class="font-weight-bold"><i class="feather icon-phone"></i> {{__('dashboard.table phone')}} :</span><span class="float-right">{{$user->phone}}</span></p>
                                            <p class="mb-3"><span class="font-weight-bold"><i class="feather icon-map"></i> {{__('dashboard.table address')}} :</span><span class="float-right">{{$user->address}}</span></p>
                                            <p class="mb-3"><span class="font-weight-bold"><i class="feather icon-user"></i> {{__('dashboard.role name')}} :</span><span class="float-right">{{$user->getRoleNames()[0]}}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="offset-1 col-6 mt-3">
                            <div class="card">
                                <div class="card-header justify-content-center">
                                    <h4 class="card-title">{{__('dashboard.edit personal information')}}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical" method="POST" action="{{route('admin.users.update.profile',auth()->user()->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row justify-content-center">
                                                    <div class="col-10 mb-2">
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
                                                    <div class="col-10 mb-2">
                                                        <div class="form-group">
                                                            <label for="first-name-icon">{{__('dashboard.table name')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="first-name-icon" value="{{$user->name}}" class="form-control" name="name" placeholder="{{__('dashboard.table name')}}">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-grid"></i>
                                                                </div>
                                                            </div>
                                                            @error('name')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-10 mb-2">
                                                        <div class="form-group">
                                                            <label for="first-name-icon">{{__('dashboard.table email')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="email" id="first-name-icon" value="{{$user->email}}" class="form-control" name="email" placeholder="{{__('dashboard.table email')}}">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-mail"></i>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-10 mb-2">
                                                        <div class="form-group">
                                                            <label for="password-icon">{{__('dashboard.table phone')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text"  class="form-control" value="{{$user->phone}}" name="phone" placeholder="{{__('dashboard.table phone')}}">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                            </div>
                                                            @error('phone')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-10 mb-2">
                                                        <div class="form-group">
                                                            <label for="contact-info-icon">{{__('dashboard.table address')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="address" class="form-control" value="{{$user->address}}" name="address" placeholder="{{__('dashboard.table address')}}"/>
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-map-marker"></i>
                                                                </div>
                                                                <input type="hidden" name="latitude" id="latitude" value="" >
                                                                <input type="hidden" name="longitude" id="longitude" value="" >
                                                            </div>
                                                            @error('address')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-10 mb-2">
                                                        <div class="form-group">
                                                            <label for="password-icon">{{__('dashboard.table password')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="password" id="password-icon" class="form-control" name="password" placeholder="{{__('dashboard.table password')}}">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-pencil"></i>
                                                                </div>
                                                            </div>
                                                            @error('password')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-10 mb-2">
                                                        <div class="form-group">
                                                            <label for="password-icon">{{__('dashboard.table confirm password')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="password" id="password-icon" class="form-control" name="password_confirmation" placeholder="{{__('dashboard.table confirm password')}}">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-pencil"></i>
                                                                </div>
                                                            </div>
                                                            @error('password_confirmation')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
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
                <div class="tab-pane " id="bank-account" aria-labelledby="profile-tab-end" aria-expanded="false" >
                    <div class="row">
                        <div class="col-4 mt-3">
                            <div class="card">
                                <div class="card-header mb-2">
                                    <h4 class="card-title">{{__('dashboard.bank-account')}}</h4>
                                </div>
                            </div>
                            @foreach($user->bank_accounts as $account)
                                <div class="card">
                                    <div class="card-content">
                                        <span class="float-right mt-1 mr-1">
                                            <form action="{{route('admin.users.bank_profile.destroy',$account->id)}}" method="POST" class="role-{{$account->id}}">
                                            @csrf
                                                @method('DELETE')
                                            <a onClick="remove({{$account->id}},'role')"><i class="feather icon-trash-2"></i></a>
                                            </form>
                                        </span>
                                        <a href="{{route('admin.users.bank_profile.edit',$account->id)}}" class="float-right mt-1 mr-1"><i class="feather icon-edit"></i></a>
                                        <div class="card-body w-auto">
                                            <div class="d-inline-block float-left">
                                                <h6 class="mb-2">{{__('dashboard.bank-name')}} :</h6>
                                                <h6 class="mb-2">{{__('dashboard.IBAN')}} :</h6>
                                                <h6 class="mb-2"> {{__('dashboard.bank account')}} :</h6>
                                                <h6 class="mb-2">{{__('dashboard.name on card')}} :</h6>
                                            </div>
                                            <div class="d-inline-block float-right">
                                                <p>{{$account->bank_name}}</p>
                                                <p>{{$account->name_on_card}}</p>
                                                <p>{{$account->IBAN}}</p>
                                                <p>{{$account->account_number}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-7 mt-3">
                            <div class="card">
                                <div class="card-header justify-content-center">
                                    <h4 class="card-title">{{__('dashboard.add bank-account')}}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical" method="POST" action="{{route('admin.users.bank_profile.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row justify-content-center">
                                                    <div class="col-9 mb-2">
                                                        <div class="form-group">
                                                            <label for="first-name-icon">{{__('dashboard.bank-name')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="first-name-icon" class="form-control" name="bank_name" placeholder="{{__('dashboard.bank-name')}}">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-grid"></i>
                                                                </div>
                                                            </div>
                                                            @error('bank_name')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-9 mb-2">
                                                        <div class="form-group">
                                                            <label for="first-name-icon">{{__('dashboard.bank account')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="number" id="first-name-icon" class="form-control" name="account_number" placeholder="{{__('dashboard.bank account')}}"
                                                                       pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" min="1111111111111111">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-grid"></i>
                                                                </div>
                                                            </div>
                                                            @error('account_number')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-9 mb-2">
                                                        <div class="form-group">
                                                            <label for="contact-info-icon">{{__('dashboard.name on card')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="contact-info-icon" class="form-control" name="name_on_card" placeholder="{{__('dashboard.name on card')}}"/>
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-pencil"></i>
                                                                </div>
                                                            </div>
                                                            @error('name_on_card')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-9 mb-2">
                                                        <div class="form-group">
                                                            <label for="password-icon">{{__('dashboard.IBAN')}}</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="number" id="password-icon" class="form-control" name="IBAN" placeholder="{{__('dashboard.IBAN')}}"
                                                                       pattern="\d*" onKeyPress="if(this.value.length==29) return false;" min="11111111111111111111111111111">
                                                                <div class="form-control-position">
                                                                    <i class="fa fa-pencil"></i>
                                                                </div>
                                                            </div>
                                                            @error('IBAN')
                                                            <span class="text text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">{{__('dashboard.submit')}}</button>
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
    </div>
    @section('script')
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyDrWqGIyXBP98tkCX9jSRrtzCpVJ-jI6ck&libraries=places"></script>
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
            });
        </script>
    @endsection
</x-dashboard.layouts.master>
