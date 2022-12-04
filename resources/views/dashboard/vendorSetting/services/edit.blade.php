<x-dashboard.layouts.master title="{{__('dashboard.edit service')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.edit service')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.services.index')}}">{{__('dashboard.service list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            @can('edit service')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.edit service')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method="POST" action="{{route('admin.services.update',$service->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <input type="text" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}" value="{{old('name_ar',$service->name_ar)}}">
                                                @error('name_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                <input type="text" class="form-control" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}" value="{{old('name_en',$service->name_en)}}">
                                                @error('name_en')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                                <input type="text" class="form-control" name="description_ar" placeholder="{{__('dashboard.table description').__('dashboard.in arabic')}}" value="{{old('description_ar',$service->description_ar)}}">
                                                @error('description_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                                <input type="text" class="form-control" name="description_en" placeholder="{{__('dashboard.table description').__('dashboard.in english')}}" value="{{old('description_en',$service->description_en)}}">
                                                @error('description_en')
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
                                                                    <option value="{{$vendor->id}}" {{$vendor->id == $service->vendor_id?'selected':''}}>{{$vendor->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                        @error('vendor_id')
                                                        <span style="font-size: 14px;" class="text-danger" id="vendor_id_error">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="first-name-icon">{{__('dashboard.sub category')}}</label>
                                                        <select name="sub_category_id" id="sub-category"
                                                                class="select2 form-control">
                                                            <option disabled selected>{{__('dashboard.choose sub category')}}</option>
                                                            @foreach($service->vendor->vendorCategories as $sub_category)
                                                                <option
                                                                    value="{{$sub_category->id}}" {{$sub_category->id == $service->vendor_category_id?'selected':''}}>{{$sub_category->name}}</option>
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
                                                                @foreach($vendors->vendorCategories as $sub_category)
                                                                    <option
                                                                        value="{{$sub_category->id}}">{{$sub_category->name}}</option>
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
                                                        <input type="checkbox" name="active" {{$service->active == 1 ?'checked':''}}>
                                                        <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                        <span class="">{{__('dashboard.table status')}}</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div id="available-sizes" class="col-12">
                                               <div id="inner-available">
                                                   <h4 class='card-title col-12' >{{__('dashboard.choose available sizes')}}</h4>
                                                   @foreach($service->vendorCategory->sizes as $size)
                                                       <div class='form-group row col-12'>
                                                           <fieldset class='checkbox  col-2'>
                                                               <div class='vs-checkbox-con vs-checkbox-primary'>

                                                                   <input type='checkbox'  id='{{$size->id}}' name='sizes[{{$size->id}}]' {{in_array($size->id ,$service->sizes()->pluck('size_id')->toArray())?'checked':''}} class='get-Sizes' >

                                                                   <span class='vs-checkbox'>
                                                            <span class='vs-checkbox--check'>
                                                                <i class='vs-icon feather icon-check'></i>
                                                            </span>
                                                        </span>
                                                                   <span>{{$size->name}}</span>
                                                               </div>
                                                           </fieldset>
                                                               <?php
                                                               $index = array_search($size->id,$service->sizes()->pluck('size_id')->toArray());
                                                               ?>
                                                           <input type='number' class='col-2  form-control inputCheckBox-{{$size->id}}' value="{{$index!==false?$service->sizes[$index]->pivot->price:''}}" style="{{in_array($size->id ,$service->sizes()->pluck('size_id')->toArray())?:'display: none'}}"  id='price"{{$size->id}}"' name='price[{{$size->id}}]' placeholder='{{__('dashboard.enter the price')}}'>
                                                       </div>
                                                   @endforeach
                                               </div>
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
                let test = $('#available-sizes #inner-available').clone();
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

            $('#sub-category').on('change',function (){
                let vendor_id = $('#vendor').val();
                let sub_category_id = $('#sub-category').val();
                if(sub_category_id =='{{$service->vendor_category_id}}'){
                    $('#available-sizes').empty();
                    $('#available-sizes').append(test);
                }else{
                    $.ajax({
                        type:"GET",
                        url:"{{route('admin.sizes.getSizesForSubCategory')}}",
                        data:{
                            vendor_id:vendor_id,
                            sub_category_id:sub_category_id
                        } ,
                        success:function (response){
                            if(response){
                                $('#available-sizes ').empty();
                                $('#available-sizes').append('<div id="inner-available"><div>');
                                if (response.length ==0){
                                    $("#available-sizes #inner-available").append("<p class='alert alert-danger text-center col-12''>{{__('dashboard.not available sizes for this sub category')}}@can('add size')  <a href='{{route('admin.sizes.index')}}' class='btn btn-black btn-sm ml-1'>Add One</a>@endcan</h4>");
                                }else{
                                    $("#available-sizes #inner-available").append("<h4 class='card-title col-12''>{{__('dashboard.choose available sizes')}}</h4>");
                                    $.each(response, function (j,i) {
                                        $("#available-sizes #inner-available").append("<div class='form-group row col-12'>"+
                                            "<fieldset class='checkbox  col-2'>"+
                                            "<div class='vs-checkbox-con vs-checkbox-primary'>"+
                                            "<input type='checkbox'  id='"+i.id+"' name='sizes["+i.id+"]' class='get-Sizes'>"+
                                            "<span class='vs-checkbox'>"+
                                            "<span class='vs-checkbox--check'>"+
                                            "<i class='vs-icon feather icon-check'></i>"+
                                            "</span>"+
                                            "</span>"+
                                            "<span>"+i.name+"</span>"+
                                            "</div>"+
                                            "</fieldset>"+
                                            "<input type='number' class='col-2  form-control inputCheckBox-"+i.id+"' style='display: none' id='price"+i.id+"' name='price["+i.id+"]' placeholder='{{__('dashboard.enter the price')}}'>"+
                                            "</div>");
                                    });
                                }
                            }
                        },
                        error:function (xhr){
                            console.log(xhr);
                        }
                    });
                }
            });
            $(document).on('change','.get-Sizes',function(){
                let value = $(this).attr("id");
                console.log(value);
                if($(this).is(':checked')){
                    $(`.inputCheckBox-${value}`).show();
                }else {
                    $(`.inputCheckBox-${value}`).hide();
                }
            });
            });
        </script>
    @endsection
</x-dashboard.layouts.master>
