<x-dashboard.layouts.master title="{{__('dashboard.add service')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.add service')}}">
            </x-dashboard.layouts.breadcrumb>
            @can('add service')
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.add service')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{route('admin.services.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                            <input type="text" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}" value="{{old('name_ar')}}">
                                            @error('name_ar')
                                            <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                            <input type="text" class="form-control" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}" value="{{old('name_en')}}">
                                            @error('name_en')
                                            <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                            <input type="text" class="form-control" name="description_ar" placeholder="{{__('dashboard.table description').__('dashboard.in arabic')}}" value="{{old('description_ar')}}">
                                            @error('description_ar')
                                            <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                            <input type="text" class="form-control" name="description_en" placeholder="{{__('dashboard.table description').__('dashboard.in english')}}" value="{{old('description_en')}}">
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
                                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
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
                                                                <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
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
                                                    <input type="checkbox"  name="active">
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
            @if(\Session::get('success'))
                <x-dashboard.layouts.message/>
            @endif
            @can('services')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.service list')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive overflow-auto">
                                    <table class="table table-striped " id="services-table">
                                        <thead>
                                        <tr class="text text-center">
                                            <th>{{__('dashboard.table name')}}</th>
                                            <th>{{__('dashboard.table description')}}</th>
                                            <th>{{__('dashboard.table image')}}</th>
                                            @if(auth()->user()->type == App\Models\User::ADMIN)
                                                <th>{{__('dashboard.vendors')}}</th>
                                            @endif
                                            <th>{{__('dashboard.sub category')}}</th>
                                            <th>{{__('dashboard.table status')}}</th>
                                            <th>{{__('dashboard.table create date')}}</th>
{{--                                            @if(auth()->user()->can('edit service') ||auth()->user()->can('delete service'))--}}
                                                <th>{{__('dashboard.actions')}}</th>
{{--                                            @endif--}}
                                        </tr>
                                        </thead>
                                        <tbody class="text text-center ">
                                        </tbody>
                                    </table>
                                </div>
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
                let service_table = $('#services-table').DataTable({

                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url: "services",
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        },
                    },
                    order: [[{{auth()->user()->type == App\Models\User::ADMIN ? 7 : 6}} , 'desc']],
                    "paging": true,
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'description', name: 'description'},
                        {data: 'image', name: 'image',render:function (data){
                            return `<img src="${data}" width="100" height="80">`;
                            }},
                        @if(auth()->user()->type == App\Models\User::ADMIN)
                        {data: 'vendor', render:function (data){
                                return data.name
                            }},
                        @endif
                        {data: 'vendor_category', render:function (data){
                                return data.name
                            }},
                        @if(!auth()->user()->hasRole('branch_manager'))
                        {data: 'active',render:function (data){
                                return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Disabled':'Active'}</span>`
                            }},
                        @else
                        {data: 'pivot',render:function (data){
                                return `<span class="badge badge-${data.available==0?'danger':'success'}">${data.available==0?'Not Available':'Available'}</span>`
                            }},
                        @endif
                        {data: 'created_at', name: 'created_at'},

                            {data: 'id', render: function (data, two, three) {
                                    @if(!auth()->user()->can('edit service') && !auth()->user()->can('delete service'))
                                    return '';
                                    @endif
                                    let edit = 'services/' + data + '/edit';
                                    let changeStatus = 'service/'+data+'/changeStatus';
                                    let deleting = 'services/' + data;

                                        return `<div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__('dashboard.actions')}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                        @can('edit service')
                                            @if(!auth()->user()->hasRole('branch_manager'))
                                            <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                            @endif
                                            <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                        @endcan
                                        @can('delete service')
                                        <form action='${deleting}' method='POST' class="role-${data}">
                                            @csrf
                                        @method('DELETE')
                                        </form>
                                        <button class="dropdown-item" onClick="remove(${data},'role')"><i class="fa fa-trash mr-1"></i>{{__('dashboard.delete')}}</button>
                                        @endcan
                                        </div>
                                        </div>
                                        </div>`;

                                }
                            }

                    ]
                });

                $('#sub-category').on('change',function (){
                    let vendor_id = $('#vendor').val();
                    let sub_category_id = $('#sub-category').val();
                    $.ajax({
                       type:"GET",
                       url:"{{route('admin.sizes.getSizesForSubCategory')}}",
                       data:{
                           vendor_id:vendor_id,
                           sub_category_id:sub_category_id
                       } ,
                        success:function (response){
                           if(response){
                               console.log('success')
                               $('#available-sizes').empty();
                               console.log(response.length);
                               if (response.length ==0){
                                   $("#available-sizes").append("<p class='alert alert-danger text-center col-12''>{{__('dashboard.not available sizes for this sub category')}}@can('add size')  <a href='{{route('admin.sizes.index')}}' class='btn btn-black btn-sm ml-1'>Add One</a>@endcan</h4>");
                               }else{
                                   $("#available-sizes").append("<h4 class='card-title col-12''>{{__('dashboard.choose available sizes')}}</h4>");
                                   $.each(response, function (j,i) {
                                       $("#available-sizes").append("<div class='form-group row col-12'>"+
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

                {{--    $('#Form-Size').submit(function (e) {
                    e.preventDefault();
                    let name_ar = $('#name_ar').val();
                    let name_en = $('#name_en').val();
                    let description_ar = $('#description_ar').val();
                    let description_en = $('#description_en').val();
                    let vendor_id = $('#vendor').val();
                    let vendor_category_id = $('#sub-category').val();
                    $.ajax({
                        url: '{{route('admin.sizes.store')}}',
                        type: "POST",
                        data: {
                            name_ar: name_ar,
                            name_en: name_en,
                            description_en: description_en,
                            description_ar: description_ar,
                            vendor_id: vendor_id,
                            vendor_category_id: vendor_category_id,
                            _token: "{{csrf_token()}}"
                        },
                        success: function (response) {
                            if (response) {
                                $('#Form-Size')[0].reset();
                                size_table.ajax.reload();
                            }
                        },
                        error: function (xhr) {
                            console.log();
                            if (xhr.responseJSON.errors['description_ar']) {
                                $('#description_ar_error').html(xhr.responseJSON.errors['description_ar']);
                            }
                            if (xhr.responseJSON.errors['description_en']) {
                                $('#description_en_error').html(xhr.responseJSON.errors['description_en']);
                            }
                            if (xhr.responseJSON.errors['name_ar']) {
                                $('#name_ar_error').html(xhr.responseJSON.errors['name_ar']);
                            }
                            if (xhr.responseJSON.errors['name_en']) {
                                $('#name_en_error').html(xhr.responseJSON.errors['name_en']);
                            }
                            if (xhr.responseJSON.errors['vendor_id']) {
                                $('#vendor_id_error').html(xhr.responseJSON.errors['vendor_id']);
                            }

                        }
                    });
                });--}}

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
