<x-dashboard.layouts.master title="{{__('dashboard.edit worksTime')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.edit worksTime')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.worksTime.index')}}">{{__('dashboard.worksTime list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            @can('edit works-time')
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('dashboard.edit worksTime')}}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="Form-Size" class="form form-vertical" method="POST" action="{{route('admin.worksTime.update',$worksTime->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="from">{{__('dashboard.from')}}</label>
                                                <input type="time" id="from" class="form-control" name="from" placeholder="{{__('dashboard.from')}}" value="{{isset($worksTime)? $worksTime->from :old('from')}}">
                                                @error('from')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="to">{{__('dashboard.to')}}</label>
                                                <input type="time" id="to" class="form-control" name="to" placeholder="{{__('dashboard.to')}}" value="{{isset($worksTime)? $worksTime->to :old('to')}}">
                                                @error('to')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="notes_ar">{{__('dashboard.notes').__('dashboard.in arabic')}}</label>
                                                <input type="text" id="notes_ar" class="form-control" name="notes_ar" placeholder="{{__('dashboard.notes').__('dashboard.in arabic')}}" value="{{isset($worksTime)? $worksTime->notes_ar :old('notes_ar')}}">
                                                @error('notes_ar')
                                                <span style="font-size: 14px;" class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="notes_en">{{__('dashboard.notes').__('dashboard.in english')}}</label>
                                                <input type="text" id="notes_en" class="form-control" name="notes_en" placeholder="{{__('dashboard.notes').__('dashboard.in english')}}" value="{{isset($worksTime)? $worksTime->notes_en :old('notes_en')}}">
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
                                                                    <option value="{{$vendor->id}}" {{$vendor->id == $worksTime->vendor_id?'selected':''}}>{{$vendor->name}}</option>
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
        </div>
    </div>
</x-dashboard.layouts.master>
