<x-dashboard.layouts.master title="{{__('dashboard.edit size')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.edit size')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.sizes.index')}}">{{__('dashboard.sizes list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            @can('edit size')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.edit size')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-Size" class="form form-vertical" method="POST" action="{{route('admin.sizes.update',$size->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="name_ar" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}" value="{{isset($size)? $size->name_ar :old('name_ar')}}">
                                                @error('name_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                <input type="text" id="name_en" class="form-control" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}" value="{{isset($size)?$size->name_en : old('name_en')}}">
                                                @error('name_en')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table description').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="description_ar" class="form-control" name="description_ar" placeholder="{{__('dashboard.table description').__('dashboard.in arabic')}}" value="{{isset($size)? $size->description_ar: old('description_ar')}}">
                                                @error('description_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                                <input type="text" id="description_en" class="form-control" name="description_en" placeholder="{{__('dashboard.table description').__('dashboard.in english')}}" value="{{isset($size)? $size->description_en : old('description_en')}}">
                                                @error('description_en')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            @if(auth()->user()->type == App\Models\User::ADMIN)
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">{{__('dashboard.vendors')}}</label>
                                                        <select name="vendor_id" id="vendor" class="select2 form-control">
{{--                                                            <optgroup label="{{__('dashboard.choose vendor')}}">--}}
                                                            <option selected disabled>{{__('dashboard.choose vendor')}}</option>
                                                                @foreach($vendors as $vendor)
                                                                    <option value="{{$vendor->id}}" {{isset($size) && $size->vendor_id == $vendor->id ? 'selected':''}}>{{$vendor->name}}</option>
                                                                @endforeach
{{--                                                            </optgroup>--}}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="first-name-icon">{{__('dashboard.sub category')}}</label>
                                                        <select name="vendor_category_id" id="sub-category"
                                                                class="select2 form-control">
                                                            <option disabled selected>{{__('dashboard.choose sub category')}}</option>
                                                            @foreach($size->vendor->vendorCategories as $sub_category)
                                                                <option
                                                                    value="{{$sub_category->id}}" {{$sub_category->id == $size->vendor_category_id?'selected':''}}>{{$sub_category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <input type="hidden" name="vendor_id" id="vendor" value="{{$vendors->id}}">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label
                                                            for="first-name-icon">{{__('dashboard.sub category')}}</label>
                                                        <select name="vendor_category_id" id="sub-category"
                                                                class="select2 form-control">
                                                            <optgroup label="{{__('dashboard.choose sub category')}}">
                                                                @foreach($vendors->vendorCategories as $sub_category)
                                                                    <option
                                                                        value="{{$sub_category->id}}" {{$sub_category->id == $size->vendor_category_id?'selected':''}}>{{$sub_category->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
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
