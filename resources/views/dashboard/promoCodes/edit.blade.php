<x-dashboard.layouts.master title="{{__('dashboard.edit promo-code')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.edit promo-code')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.promoCodes.index')}}">{{__('dashboard.promo-code list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.edit promo-code')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-Size" class="form form-vertical" method="POST" action="{{route('admin.promoCodes.update',$promo->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$promo->id}}">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">{{__('dashboard.code')}}</label>
                                                <input type="text" id="promo_code" class="form-control" name="promo_code"
                                                       placeholder="{{__('dashboard.code')}}"
                                                       value="{{old('promo_code',$promo->promo_code)}}">
                                                @error('promo_code')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.available until')}}</label>
                                                <input type="date" id="available_until" class="form-control" name="available_until"
                                                       placeholder="{{__('dashboard.available until').'  .......  '.__('dashboard.in days')}}"
                                                       value="{{old('available_until',$promo->available_until)}}">
                                                @error('available_until')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.discount_amount')}}</label>
                                                <input type="number" id="discount_amount" class="form-control"
                                                       name="discount_amount"
                                                       placeholder="{{__('dashboard.discount_amount')}}"
                                                       value="{{old('discount_amount',$promo->discount_amount)}}">
                                                @error('discount_amount')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.number_of_use')}}</label>
                                                <input type="number" id="number_of_use" class="form-control"
                                                       name="number_of_use"
                                                       placeholder="{{__('dashboard.number_of_use')}}"
                                                       value="{{old('number_of_use',$promo->number_of_use)}}">
                                                @error('number_of_use')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label
                                                    for="name">{{__('dashboard.min_amount')}}</label>
                                                <input type="number" id="min_amount" class="form-control"
                                                       name="min_amount"
                                                       placeholder="{{__('dashboard.min_amount')}}"
                                                       value="{{old('min_amount',$promo->min_amount)}}">
                                                @error('min_amount')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" name="active" id="active" {{$promo->active == 1?'checked':''}}>
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
        </div>
    </div>
</x-dashboard.layouts.master>
