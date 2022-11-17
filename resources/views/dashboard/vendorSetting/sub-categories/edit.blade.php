<x-dashboard.layouts.master title="{{__('dashboard.edit sub-category')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.edit sub-category')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.subCategories.index')}}">{{__('dashboard.sub category list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            @can('edit sub-category')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.edit sub-category')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-sub-category" method="POST" enctype="multipart/form-data" action="{{route('admin.subCategories.update',$subCategory->id)}}" class="form form-vertical">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="name_ar" class="form-control"  name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}" value="{{$subCategory->name_ar}}">
                                                @error('name_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                <input type="text" id="name_en" class="form-control" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}" value="{{$subCategory->name_en}}">
                                                @error('name_en')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table description').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="description_ar" class="form-control" name="description_ar" placeholder="{{__('dashboard.table description').__('dashboard.in arabic')}}" value="{{$subCategory->description_ar}}">
                                                @error('description_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                                <input type="text" id="description_en" class="form-control" name="description_en" placeholder="{{__('dashboard.table description').__('dashboard.in english')}}" value="{{$subCategory->description_en}}">
                                                @error('description_en')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            @if(auth()->user()->type == App\Models\User::ADMIN)
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">{{__('dashboard.vendors')}}</label>
                                                        <select name="vendor_id" id="vendor" class="select2 form-control">
                                                            <optgroup label="{{__('dashboard.choose vendor')}}">
                                                                @foreach($vendors as $vendor)
                                                                    <option value="{{$vendor->id}}" {{$vendor->id == $subCategory->vendor_id ? 'selected':''}}>{{$vendor->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <input type="hidden" name="vendor_id" id="vendor" value="{{$vendors->id}}">
                                            @endif
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email-id-icon">{{__('dashboard.table image')}}</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="file" id="image-sub-cat" class="form-control" name="image">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-image"></i>
                                                        </div>
                                                    </div>
                                                    @error('image')
                                                    <span class="text text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="active" {{$subCategory->active ==1 ? 'checked':''}}>
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
            @endcan
        </div>
    </div>
</x-dashboard.layouts.master>
