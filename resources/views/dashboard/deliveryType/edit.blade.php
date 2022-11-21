<x-dashboard.layouts.master title="{{__('dashboard.edit delivery-type')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.edit delivery-type')}}">
            </x-dashboard.layouts.breadcrumb>
            @can('edit delivery-types')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.edit delivery-type')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-delivery" class="form form-vertical" method="POST" action="{{route('admin.deliveryTypes.update',$deliveryType->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.table name').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="type_ar" class="form-control" name="type_ar"
                                                       placeholder="{{__('dashboard.table name').__('dashboard.in arabic')}}"
                                                       value="{{old('type_ar',$deliveryType->type_ar)}}">
                                                <span style="font-size: 14px;" class="text-danger"
                                                      id="type_ar_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.table name').__('dashboard.in english')}}</label>
                                                <input type="text" id="type_en" class="form-control" name="type_en"
                                                       placeholder="{{__('dashboard.table name').__('dashboard.in english')}}"
                                                       value="{{old('type_en',$deliveryType->type_en)}}">
                                                <span style="font-size: 14px;" class="text-danger" id="type_en_error"></span>
                                            </div>
                                            <div class="form-group col-6">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="active" id="active" {{$deliveryType->active == 1 ? 'checked':''}}>
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
