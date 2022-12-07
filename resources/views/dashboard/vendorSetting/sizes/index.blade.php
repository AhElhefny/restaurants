<x-dashboard.layouts.master title="{{__('dashboard.add size')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.add size')}}">
            </x-dashboard.layouts.breadcrumb>
            @can('add size')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.add size')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-Size" class="form form-vertical">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="name_ar" class="form-control" name="name_ar"
                                                       placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}"
                                                       value="{{old('name_ar')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="name_ar_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                <input type="text" id="name_en" class="form-control" name="name_en"
                                                       placeholder="{{__('dashboard.table name').__('dashboard.in english')}}"
                                                       value="{{old('name_en')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="name_en_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.table description').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="description_ar" class="form-control"
                                                       name="description_ar"
                                                       placeholder="{{__('dashboard.table description').__('dashboard.in arabic')}}"
                                                       value="{{old('description_ar')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="description_ar_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                                <input type="text" id="description_en" class="form-control"
                                                       name="description_en"
                                                       placeholder="{{__('dashboard.table description').__('dashboard.in english')}}"
                                                       value="{{old('description_en')}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="description_en_error"></span>
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
{{--                                                        <optgroup label="{{__('dashboard.choose sub category')}}">--}}
                                                            <option disabled selected>{{__('dashboard.choose sub category')}}</option>
{{--                                                        </optgroup>--}}
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
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1 mb-1">{{__('dashboard.submit')}}</button>
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
            @can('sizes')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.sizes list')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive overflow-auto">
                                    <table class="table table-striped " id="sizes-table">
                                        <thead>
                                        <tr class="text text-center">
                                            {{--                                        <th>#</th>--}}
                                            <th>{{__('dashboard.table name')}}</th>
                                            <th>{{__('dashboard.table description')}}</th>
                                            @if(auth()->user()->type != App\Models\User::VENDOR)
                                            <th>{{__('dashboard.vendors')}}</th>
                                            @endif
                                            <th>{{__('dashboard.sub category')}}</th>
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
                let size_table = $('#sizes-table').DataTable({

                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url: "sizes",
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        },
                    },
                    order: [[@if(auth()->user()->type == 3)4 @else 5 @endif, 'desc']],
                    "paging": true,
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'description', name: 'description'},
                        @if(auth()->user()->type == App\Models\User::ADMIN)
                        {data: 'vendor', render:function (data){
                                return data.name
                            }},
                        @endif
                        {data: 'sub_categories', render:function (data){
                                return data.name
                            }},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'id',
                            render: function (data, two, three) {
                                let edit = 'sizes/' + data + '/edit';
                                let deleting = 'sizes/' + data;
                                @if(auth()->user()->can('edit size')||auth()->user()->can('delete size'))
                                    return `<div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{__('dashboard.actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                @can('edit size')
                                <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                    @endcan
                                @can('delete size')
                                <form action='${deleting}' method='POST' class="role-${data}">
                                    @csrf
                                @method('DELETE')
                                </form>
                                <button class="dropdown-item" onClick="remove(${data},'role')"><i class="fa fa-trash mr-1"></i>{{__('dashboard.delete')}}</button>
                                @endcan
                                </div>
                                </div>
                            </div>`;
                                @endif
                                return ''
                            }
                        },
                    ]
                });

                $('#Form-Size').submit(function (e) {
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
