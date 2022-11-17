<x-dashboard.layouts.master title="{{__('dashboard.edit vendor')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.edit vendor')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.vendors.index')}}">{{__('dashboard.vendor list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.edit vendor')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{route('admin.vendors.update',$vendor->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
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
                                                <label for="first-name-icon">{{__('dashboard.category')}}</label>
                                                <select name="category_id" class="select2 form-control">
                                                    <optgroup label="{{__('dashboard.choose category')}}">
                                                        @foreach($category as $cat)
                                                            <option value="{{$cat->id}}" {{$cat->id != $vendor->category_id ?:'selected'}}>{{$cat->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-icon">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="first-name-icon" value="{{$vendor->name_ar}}" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}">
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
                                                    <input type="text" id="first-name-icon" class="form-control" value="{{old('name_en',$vendor->name_en)}}" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}">
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
                                                <label for="contact-info-icon">{{__('dashboard.table description'). __('dashboard.in arabic')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="contact-info-icon" class="form-control" value="{{$vendor->description_ar}}" name="description_ar" placeholder="{{__('dashboard.table description'). __('dashboard.in arabic')}}"/>
                                                    <div class="form-control-position">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </div>
                                                @error('description_ar')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table description'). __('dashboard.in english')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="password-icon"  class="form-control" value="{{$vendor->description_en}}" name="description_en" placeholder="{{__('dashboard.table description'). __('dashboard.in english')}}" autocomplete="off">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </div>
                                                @error('description_en')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table address')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="password-icon" class="form-control" value="{{$vendor->user->address}}" name="address" placeholder="{{__('dashboard.table address')}}">
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table phone')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text"  class="form-control" value="{{$vendor->user->phone}}" name="phone" placeholder="{{__('dashboard.table phone')}}">
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
                                                <label for="password-icon">{{__('dashboard.table tax')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="number"  class="form-control" value="{{$vendor->tax}}" name="tax" placeholder="{{__('dashboard.table tax')}}">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-usd"></i>
                                                    </div>
                                                </div>
                                                @error('tax')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table email')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="email"  class="form-control" value="{{$vendor->user->email}}" name="email" placeholder="{{__('dashboard.table email')}}">
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
                                        <div class="form-group col-6">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" {{$vendor->active == 0?:'checked'}} name="active">
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
</x-dashboard.layouts.master>
