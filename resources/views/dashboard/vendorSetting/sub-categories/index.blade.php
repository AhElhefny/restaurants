<x-dashboard.layouts.master title="{{__('dashboard.add sub-category')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.add sub-category')}}">
            </x-dashboard.layouts.breadcrumb>
            @can('add sub-category')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.add sub-category')}}</h4>
                        </div>
                        @if(\Session::get('success'))
                            <x-dashboard.layouts.message />
                        @endif
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-sub-category" method="POST" enctype="multipart/form-data" action="{{route('admin.subCategories.store')}}" class="form form-vertical">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="name_ar" class="form-control" name="name_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}" value="{{old('name_ar')}}">
                                                @error('name_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                <input type="text" id="name_en" class="form-control" name="name_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}" value="{{old('name_en')}}">
                                                @error('name_en')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table description').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="description_ar" class="form-control" name="description_ar" placeholder="{{__('dashboard.table description').__('dashboard.in arabic')}}" value="{{old('description_ar')}}">
                                                @error('description_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table description').__('dashboard.in english')}}</label>
                                                <input type="text" id="description_en" class="form-control" name="description_en" placeholder="{{__('dashboard.table description').__('dashboard.in english')}}" value="{{old('description_en')}}">
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
                                                                    <option value="{{$vendor->id}}">{{$vendor->name}}</option>
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
                                                        <input type="checkbox" name="active">
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
            @if(\Session::get('success'))
                <x-dashboard.layouts.message/>
            @endif
            @can('sub-categories')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.sub category list')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive overflow-auto">
                                    <table class="table table-striped " id="sub-category-table">
                                        <thead >
                                        <tr class="text text-center">
                                            <th>{{__('dashboard.table name')}}</th>
                                            <th>{{__('dashboard.table description')}}</th>
                                            <th>{{__('dashboard.table image')}}</th>
                                            <th>{{__('dashboard.table status')}}</th>
                                            @if(auth()->user()->type != App\Models\User::VENDOR)
                                            <th>{{__('dashboard.vendors')}}</th>
                                            @endif
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
                let table = $('#sub-category-table').DataTable({

                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url :"subCategories",
                        headers:{'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        }
                    },
                    "paging": true,
                    order:[[{{auth()->user()->type == 3?5:6}},'desc']],
                    columns: [
                        {data: 'name', name:'name'},
                        {data: 'description', name:'description'},
                        {data: 'image', name:'image',render:function (data){
                            return `<img src="${data}" width="100" height="80">`
                            }},
                        {data: 'active', render:function(data){
                                return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Disabled':'Active'}</span>`
                            }},
                        @if(auth()->user()->type == App\Models\User::ADMIN)
                        {data: 'vendor', render:function (data){
                                return data.name
                            }},
                        @endif
                        {data: 'created_at', name: 'created_at'},
                        {data: 'id',
                            render:function (data,two,three){
                                let edit ='subCategories/'+data+'/edit';
                                let changeStatus = 'subCategories/'+data+'/changeStatus';
                                // let show ='subCategories/'+data;
                                @can('edit sub-category','show sub-category')
                                    return `<div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{__('dashboard.actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                @can('edit sub-category')
                                    <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                    <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                @endcan
{{--                                @can('show sub-category')--}}
{{--                                    <a class="dropdown-item" href="${show}"><i class="fa fa-eye mr-1"></i>{{__('dashboard.show')}}</a>--}}
{{--                                @endcan--}}
                                </div>
                                </div>
                            </div>`;
                                @endcan
                            }
                        },
                    ]
                });

                {{-- $('#Form-sub-category').submit(function (e){
                e.preventDefault();
                let name_ar =$('#name_ar').val();
                let name_en =$('#name_en').val();
                let description_ar =$('#description_ar').val();
                let description_en =$('#description_en').val();
                let vendor_id =$('#vendor').val();
                var fd = new FormData();
                var files = $('#image-sub-cat')[0].files[0];
                fd.append('file',files);
                $.ajax({
                    url:'{{route('admin.subCategories.store')}}',
                    headers: { 'X-CSRF-Token': "{{ csrf_token() }}" },
                    type:"POST",
                    data:{
                        name_ar:name_ar,
                        name_en:name_en,
                        description_en:description_en,
                        description_ar:description_ar,
                        vendor_id:vendor_id,
                        fd,
                    } ,
                    contentType: false,
                    processData: false,
                    success:function (response){
                        if(response){
                            $('#Form-sub-category')[0].reset();
                            table.ajax.reload();
                        }
                    },
                    error:function (xhr){
                        console.log(xhr.responseJSON);
                    }
                });
            });--}}
        });

        </script>
    @endsection
</x-dashboard.layouts.master>
