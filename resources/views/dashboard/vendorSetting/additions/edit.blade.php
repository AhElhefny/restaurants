<x-dashboard.layouts.master title="{{__('dashboard.edit addition')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.edit addition')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.addition.index')}}">{{__('dashboard.additions list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            @can('edit addition')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.edit addition')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method="POST" action="{{route('admin.addition.update',$addition->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <input type="text" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}" value="{{old('name_ar',$addition->name_ar)}}">
                                                @error('name_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                <input type="text" class="form-control" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}" value="{{old('name_en',$addition->name_en)}}">
                                                @error('name_en')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.min')}}</label>
                                                <input type="number" class="form-control" name="min" placeholder="{{__('dashboard.min')}}" value="{{old('min',$addition->min)}}" min="0" max="20">
                                                @error('min')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.max')}}</label>
                                                <input type="number" class="form-control" name="max" placeholder="{{__('dashboard.max')}}" value="{{old('max',$addition->max)}}" min="0" max="20">
                                                @error('max')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.price')}}</label>
                                                <input type="number" class="form-control" name="price" placeholder="{{__('dashboard.price')}}" value="{{old('price',$addition->price)}}" min="0">
                                                @error('price')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.slug')}}</label>
                                                <input type="text" class="form-control" name="slug" placeholder="like cheese, soda, etc... " value="{{old('slug',$addition->slug)}}" >
                                                @error('slug')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            @if(auth()->user()->type == App\Models\User::ADMIN)
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">{{__('dashboard.vendors')}}</label>
                                                        <select name="vendor_id" id="vendor"
                                                                class="select2 form-control">
                                                            <optgroup label="{{__('dashboard.choose vendor')}}">
                                                                <option selected disabled>{{__('dashboard.choose vendor')}}</option>
                                                                @foreach($vendors as $vendor)
                                                                    <option value="{{$vendor->id}}" {{$addition->vendor->id == $vendor->id ? 'selected':''}}>{{$vendor->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                        <span style="font-size: 14px;" class="text-danger"
                                                              id="vendor_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="first-name-icon">{{__('dashboard.sub category')}}</label>
                                                        <select name="sub_category_id" id="sub-category"
                                                                class="select2 form-control">
                                                            <option disabled selected>{{__('dashboard.choose sub category')}}</option>
                                                            @foreach($addition->vendor->vendorCategories as $sub_category)
                                                                <option
                                                                    value="{{$sub_category->id}}" {{$sub_category->id == $addition->vendor_category_id?'selected':''}}>{{$sub_category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @else
                                                <input type="hidden" name="vendor_id" id="vendor"
                                                       value="{{$vendors->id}}">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="first-name-icon">{{__('dashboard.sub category')}}</label>
                                                        <select name="sub_category_id" id="sub-category"
                                                                class="select2 form-control">
                                                            <optgroup label="{{__('dashboard.choose sub category')}}">
                                                                <option value="" selected disabled>{{__('dashboard.choose sub category')}}</option>
                                                                @foreach($vendors->vendorCategories as $sub_category)
                                                                    <option value="{{$sub_category->id}}" {{$addition->vendorCategory->id == $sub_category->id ? 'selected':''}}>{{$sub_category->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
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
                                                        <input type="checkbox"  name="active" {{$addition->active == 1 ? 'checked':''}}>
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
    @section('script')
        <script>
            $(document).ready(function () {
                $('#vendor').on('change', function () {
                    var selectedVendor = $(this).find('option:selected');
                    let vendor_id = selectedVendor.val();
                    $.ajax({
                        url: "{{route('admin.vendors.sub_categories')}}",
                        type: "GET",
                        data: {
                            vendor_id: vendor_id,
                        },
                        success: function (response) {
                            $("#sub-category").empty();
                            if (response) {
                                $("#sub-category").append("<option value='' disabled selected>{{__('dashboard.choose sub category')}}</option>")
                                $.each(response, function (j,i) {
                                    $("#sub-category").append("<option value='" + i.id + "'>" + i.name + "</option>");
                                });
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
</x-dashboard.layouts.master>
