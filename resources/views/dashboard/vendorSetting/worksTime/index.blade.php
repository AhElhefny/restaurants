<x-dashboard.layouts.master title="{{__('dashboard.add worksTime')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.add worksTime')}}">
            </x-dashboard.layouts.breadcrumb>
            @can('add works-time')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.add worksTime')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-Size" class="form form-vertical" method="POST" action="{{route('admin.worksTime.store')}}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="from">{{__('dashboard.from')}}</label>
                                                <input type="time" id="from" class="form-control" name="from" placeholder="{{__('dashboard.from')}}" value="{{old('from')}}">
                                                @error('from')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="to">{{__('dashboard.to')}}</label>
                                                <input type="time" id="to" class="form-control" name="to" placeholder="{{__('dashboard.to')}}" value="{{old('to')}}">
                                                @error('to')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="notes_ar">{{__('dashboard.notes').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="notes_ar" class="form-control" name="notes_ar" placeholder="{{__('dashboard.notes').__('dashboard.in arabic')}}" value="{{old('notes_ar')}}">
                                                @error('notes_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="notes_en">{{__('dashboard.notes').__('dashboard.in english')}}</label>
                                                <input type="text" id="notes_en" class="form-control" name="notes_en" placeholder="{{__('dashboard.notes').__('dashboard.in english')}}" value="{{old('notes_en')}}">
                                                @error('notes_en')
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
                                                        <span style="font-size: 14px;" class="text-danger" id="vendor_id_error">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @else
                                                <input type="hidden" name="vendor_id" id="vendor" value="{{$vendors->id}}">
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
            @if(\Session::get('success'))
                <x-dashboard.layouts.message/>
            @endif
            @can('works-time')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.worksTime list')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="table-responsive overflow-auto">
                                    <table class="table table-striped " id="worksTime-table">
                                        <thead>
                                        <tr class="text text-center">
                                            <th>{{__('dashboard.from')}}</th>
                                            <th>{{__('dashboard.to')}}</th>
                                            @if(auth()->user()->type != App\Models\User::VENDOR)
                                                <th>{{__('dashboard.vendors')}}</th>
                                            @endif
                                            <th>{{__('dashboard.notes')}}</th>
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
                let size_table = $('#worksTime-table').DataTable({

                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 20, 40, 60, 80, 100],
                    pageLength: 10,
                    ajax: {
                        url: "worksTime",
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        data: function (d) {
                            d.page = 1;
                        },
                    },
                    order: [[@if(auth()->user()->type == 3)4 @else 5 @endif, 'desc']],
                    "paging": true,
                    columns: [
                        {data: 'from', name: 'from'},
                        {data: 'to', name: 'to'},
                            @if(auth()->user()->type == App\Models\User::ADMIN)
                        {data: 'vendor', render:function (data){
                                return data.name
                            }},
                            @endif
                        {data: 'notes', name: 'notes'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'id',
                            render: function (data, two, three) {
                                let edit = 'worksTime/' + data + '/edit';
                                let deleting = 'worksTime/' + data;
                                @can('edit works-time','delete works-time')
                                    return `<div class="btn-group">
                                <div class="dropdown">
                                    <button class="btn btn-flat-dark dropdown-toggle mr-1 mb-1" type="button" id="dropdownMenuButton700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{__('dashboard.actions')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton700">
                                @can('edit works-time')
                                <a class="dropdown-item" href="${edit}"><i class="fa fa-edit mr-1"></i>{{__('dashboard.edit')}}</a>
                                    @endcan
                                @can('delete works-time')
                                <form action='${deleting}' method='POST' class="works-time-${data}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="dropdown-item" onClick="remove(${data},'works-time')"><i class="fa fa-trash mr-1"></i>{{__('dashboard.delete')}}</button>
                                @endcan
                                </div>
                                </div>
                            </div>`;
                                @endcan
                            }
                        },
                    ]
                });
            });

        </script>
    @endsection
</x-dashboard.layouts.master>
