<x-dashboard.layouts.master title="{{__('dashboard.offers list')}}">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-dashboard.layouts.breadcrumb now="{{__('dashboard.offers list')}}">
            </x-dashboard.layouts.breadcrumb>
            <section id="content-types">
                <div class="row match-height">
                    @foreach($offers as $offer)
                        <div class="col-xl-4 col-md-6">
                            <div class="card" title="{{$offer->active == 1?'ACTIVE':'IN-ACTIVE'}}" style="height: auto">
                                <div class="card-header mb-1">
                                    <h4 class="card-title">{{$offer->title}}</h4>
                                    <button type="button" style="margin-top: 97px;position: absolute;left: 3px" class="btn btn-icon btn-icon rounded-circle btn-outline-{{$offer->active == 1? 'primary':'danger'}}  waves-effect waves-light">
                                        <i class="feather icon-{{$offer->active == 1?'check':'x'}}"></i>
                                    </button>
                                    <div class="dropdown chart-dropdown">
                                        <button class="btn btn-sm border-0 dropdown-toggle p-0" type="button" id="dropdownItem5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{__('dashboard.actions')}}
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem5">
                                            <a class="dropdown-item" href="{{route('admin.offers.edit',$offer->id)}}">{{__('dashboard.edit')}}</a>
                                            <a class="dropdown-item" href="{{route('admin.offers.changeStatus',$offer->id)}}">{{__('dashboard.change status')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <img class="" src="{{$offer->image}}" alt="Card image cap" height="294px" width="100%">
                                    <div class="card-body" style="height: 100px; overflow: hidden">
                                        <p class="card-text">{{$offer->description}}.</p>
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <span class="float-left">{{$offer->created_at}}</span>
                                    <span class="float-right">
                                            <a href="{{$offer->link??'#'}}" target="_blank" class="card-link">{{__('dashboard.Go-To link')}}<i class="fa fa-angle-right"></i></a>
                                        </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <div id="paginator-offers" style="position: relative; left: -600px; top: 5px">
                {!! $offers->links() !!}
            </div>
        </div>

    </div>
</x-dashboard.layouts.master>
