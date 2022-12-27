<x-dashboard.layouts.master title="{{__('dashboard.additions list')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.additions list')}}">
            </x-dashboard.layouts.breadcrumb>
            @can('add addition')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.add addition')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method="POST" action="{{route('admin.addition.store')}}" enctype="multipart/form-data">
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
                                                <label for="name">{{__('dashboard.slug')}}</label>
                                                <input type="text" class="form-control" name="slug" placeholder="{{__('dashboard.slug')}}" value="{{old('slug')}}">
                                                @error('slug')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.min')}}</label>
                                                <input type="number" class="form-control" name="min" placeholder="{{__('dashboard.min')}}" value="{{old('min')}}" min="0" max="20">
                                                @error('min')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.max')}}</label>
                                                <input type="number" class="form-control" name="max" placeholder="{{__('dashboard.max')}}" value="{{old('max')}}" min="0" max="50">
                                                @error('max')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.price')}}</label>
                                                <input type="number" class="form-control" name="price" placeholder="{{__('dashboard.price')}}" value="{{old('price')}}" min="0">
                                                @error('price')
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
                                                        @error('vendor_id')
                                                        <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
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
                                                        </select>
                                                        @error('sub_category_id')
                                                        <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                        @enderror
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
                                                        @error('sub_category_id')
                                                        <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                        @enderror
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
            @can('additions')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.additions list')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive overflow-auto">
                                    <table class="table table-striped " id="additions-table">
                                        <thead>
                                        <tr class="text text-center">
                                            <th>{{__('dashboard.table name')}}</th>
                                            <th>{{__('dashboard.slug')}}</th>
                                            @if(auth()->user()->type == App\Models\User::ADMIN)
                                                <th>{{__('dashboard.vendors')}}</th>
                                            @endif
                                            <th>{{__('dashboard.sub category')}}</th>
                                            <th>{{__('dashboard.min')}}</th>
                                            <th>{{__('dashboard.max')}}</th>
                                            <th>{{__('dashboard.price')}}</th>
                                            <th>{{__('dashboard.table status')}}</th>
                                            <th>{{__('dashboard.table create date')}}</th>
                                            <th>{{__('dashboard.actions')}}</th>
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
                let service_table = $('#additions-table').DataTable({
                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url: "addition",
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        },
                    },
                    order: [[{{auth()->user()->type == App\Models\User::ADMIN ? 9 : 8}} , 'desc']],
                    "paging": true,
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'slug', name: 'slug'},
                            @if(auth()->user()->type == App\Models\User::ADMIN)
                        {data: 'vendor', render:function (data){
                                return data.name
                            }},
                            @endif
                        {data: 'vendor_category', render:function (data){
                                return data.name
                            }},
                        {data: 'min', name: 'min'},
                        {data: 'max', name: 'max',render:function (data) {
                                if (data)
                                    return data;
                                else
                                    return '-';
                            }},
                        {data: 'price', name: 'price'},
                        {data: 'active',render:function (data){
                                return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Disabled':'Active'}</span>`
                            }},
                        {data: 'created_at', name: 'created_at'},

                        {data: 'id', render: function (data, two, three) {
                                @if(!auth()->user()->can('edit addition'))
                                    return '';
                                @endif
                                let edit = 'addition/' + data + '/edit';
                                let changeStatus = 'addition/'+data+'/changeStatus';

                                return `<div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{__('dashboard.actions')}}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                            @can('edit addition')
                                                <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                                <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                            @endcan
                                            </div>
                                        </div>
                                        </div>`;
                            }
                        }
                    ]
                });


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
