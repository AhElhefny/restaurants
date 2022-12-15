<x-dashboard.layouts.master title="{{isset($offer)?__('dashboard.edit offer'):__('dashboard.add offer')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{isset($offer)?__('dashboard.edit offer'):__('dashboard.add offer')}}">
                <li class="breadcrumb-item"><a href="{{route('admin.offers.index')}}">{{__('dashboard.offers list')}}</a></li>
            </x-dashboard.layouts.breadcrumb>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{isset($offer)?__('dashboard.edit offer'):__('dashboard.add offer')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{isset($offer)?route('admin.offers.update',$offer->id):route('admin.offers.store')}}" enctype="multipart/form-data">
                                @csrf
                                @if(isset($offer))
                                    @method('PUT')
                                @endif
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email-id-icon">{{__('dashboard.table image')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="file" id="email-id-icon" class="form-control" name="image">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-image"></i>
                                                    </div>
                                                </div>
                                                @error('image')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-icon">{{__('dashboard.title')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="first-name-icon" value="{{old('title',isset($offer)?$offer->title:'')}}" class="form-control" name="title" placeholder="{{__('dashboard.title')}}">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-grid"></i>
                                                    </div>
                                                </div>
                                                @error('title')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.table description')}}</label>
                                                <div class="position-relative has-icon-left">
{{--                                                    <input type="text" id="description" class="form-control" value="{{old('description',isset($offer)?$offer->description:'')}}" name="description" placeholder="{{__('dashboard.table description')}}">--}}
                                                    <textarea name="description" class="form-control">{{old('description',isset($offer)?$offer->description:'')}}</textarea>
                                                    <div class="form-control-position">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </div>
                                                @error('description')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="password-icon">{{__('dashboard.link')}}</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text"  class="form-control" value="{{old('link',isset($offer)?$offer->link:'')}}" name="link" placeholder="{{__('dashboard.link')}}">
                                                    <div class="form-control-position">
                                                        <i class="fa fa-link"></i>
                                                    </div>
                                                </div>
                                                @error('link')
                                                <span class="text text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" name="active" id="active" {{isset($offer)&& $offer->active == 1 ? 'checked':''}}>
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
                                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('dashboard.reset')}}</button>
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
    @section('script')
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyDrWqGIyXBP98tkCX9jSRrtzCpVJ-jI6ck&libraries=places"></script>

        <script>
            google.maps.event.addDomListener(window, 'load', initialize);
            function initialize() {
                var input = document.getElementById('address');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    // place variable will have all the information you are looking for.
                });
            }
        </script>
    @endsection
</x-dashboard.layouts.master>
