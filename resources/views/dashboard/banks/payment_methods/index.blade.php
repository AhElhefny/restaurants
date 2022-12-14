<x-dashboard.layouts.master title="{{__('dashboard.payment_methods')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{isset($method)?__('dashboard.edit payment_method'):__('dashboard.payment_methods')}}">
                @if(isset($method))
                <li class="breadcrumb-item"><a href="{{route('admin.payment_methods.index')}}">{{__('dashboard.payment_methods')}}</a></li>
                @endif
            </x-dashboard.layouts.breadcrumb>
            @can('add payment-methods')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{isset($method)?__('dashboard.edit payment_method'):__('dashboard.add payment_method')}}</h4>
                        </div>
                        @if(\Session::get('success'))
                            <x-dashboard.layouts.message />
                        @endif
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-payment-methods" method="POST" enctype="multipart/form-data"
                                      action="{{isset($method)?route('admin.payment_methods.update',$method->id):route('admin.payment_methods.store')}}"
                                      class="form form-vertical">

                                    @csrf
                                    @if(isset($method))
                                        @method('PUT')
                                    @endif
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="method_ar" class="form-control" name="method_ar" placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}" value="{{old('method_ar',isset($method)?$method->method_ar:'')}}">
                                                @error('method_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                <input type="text" id="method_en" class="form-control" name="method_en" placeholder="{{__('dashboard.table name').__('dashboard.in english')}}" value="{{old('method_en',isset($method)?$method->method_en:'')}}">
                                                @error('method_en')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email-id-icon">{{__('dashboard.table image')}}</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="file" id="image-sub-cat" class="form-control" name="icon">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-image"></i>
                                                        </div>
                                                    </div>
                                                    @error('icon')
                                                    <span class="text text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="active" {{isset($method)&&$method->active == 1?'checked':''}}>
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
            @if(!isset($method))
            @can('payment-methods')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.payment_methods')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive overflow-auto">
                                    <table class="table table-striped " id="payment-method-table">
                                        <thead >
                                        <tr class="text text-center">
                                            <th>{{__('dashboard.table name')}}</th>
                                            <th>{{__('dashboard.table image')}}</th>
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
            @endif
        </div>
    </div>
    @if(!isset($method))
    @section('script')
        <script>
            $(document).ready(function () {
                $('#payment-method-table').DataTable({

                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url :"payment_methods",
                        headers:{'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        }
                    },
                    "paging": true,
                    order: [[4 , 'desc']],
                    columns: [
                        {data: 'method', name:'method'},
                        {data: 'icon',render:function (data){
                                return `<img src="${data}" width="100" height="80">`
                            }},
                        {data: 'active', render:function(data){
                                return `<span class="badge badge-${data==0?'danger':'success'}">${data==0?'Disabled':'Active'}</span>`
                            }},

                        {data: 'created_at', name: 'created_at'},

                        {data: 'id',
                            render:function (data,two,three){
                                let edit ='payment_methods/'+data+'/edit';
                                let changeStatus = 'payment_methods/'+data+'/changeStatus';
                                @if(auth()->user()->can('edit payment-methods'))
                                return `<div class="btn-group">
                                    <div class="dropdown">
                                        <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__('dashboard.actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                @can('edit payment-methods')
                                    <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                    <a class="dropdown-item" href="${changeStatus}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.change status')}}</a>
                                @endcan
                                </div>
                                </div>
                            </div>`;
                                @endif
                                return ''
                            }
                        }

                    ]
                });
            });
        </script>
    @endsection
    @endif
</x-dashboard.layouts.master>
