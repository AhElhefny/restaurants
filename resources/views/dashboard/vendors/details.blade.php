<x-dashboard.layouts.master title="{{__('dashboard.show vendor')}}">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <x-dashboard.layouts.breadcrumb now="{{__('dashboard.show vendor')}}">
            <li class="breadcrumb-item"><a href="{{route('admin.vendors.index')}}">{{__('dashboard.vendor list')}}</a></li>
        </x-dashboard.layouts.breadcrumb>
        <div class="content-body">
            <!-- page users view start -->
            <section class="page-users-view">
                <div class="row">
                    <!-- account start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{__('dashboard.account')}}</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="users-view-image">
                                        <img src="{{$vendor->user->image}}" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                    </div>
                                    <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                        <table>
                                            <tr>
                                                <td class="font-weight-bold">{{__('dashboard.table name')}}</td>
                                                <td>{{$vendor->name}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">{{__('dashboard.table phone')}}</td>
                                                <td>{{$vendor->user->phone}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">{{__('dashboard.table email')}}</td>
                                                <td>{{$vendor->user->email}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-5">
                                        <table class="ml-0 ml-sm-0 ml-lg-0">
                                            <tr>
                                                <td class="font-weight-bold">{{__('dashboard.table status')}}</td>
                                                <td>{{$vendor->active == 1 ? 'Active' : 'Disabled'}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">{{__('dashboard.table address')}}</td>
                                                <td>{{$vendor->user->address}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">{{__('dashboard.category')}}</td>
                                                <td>{{$vendor->category->name}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    @can('edit vendor')
                                    <div class="col-12">
                                        <a href="{{route('admin.vendors.edit',$vendor->id)}}" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i> {{__('dashboard.edit')}}</a>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--////////////////////////////////////////////////// --}}
{{--                    <div class="item-features py-5">--}}
{{--                        <div class="row text-center pt-2">--}}
{{--                            <div class="col-12 col-md-4 mb-4 mb-md-0 ">--}}
{{--                                <div class="w-75 mx-auto">--}}
{{--                                    <i class="feather icon-award text-primary font-large-2"></i>--}}
{{--                                    <h5 class="mt-2 font-weight-bold">100% Original</h5>--}}
{{--                                    <p>Chocolate bar candy canes ice cream toffee. Croissant pie cookie halvah.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12 col-md-4 mb-4 mb-md-0">--}}
{{--                                <div class="w-75 mx-auto">--}}
{{--                                    <i class="feather icon-clock text-primary font-large-2"></i>--}}
{{--                                    <h5 class="mt-2 font-weight-bold">10 Day Replacement</h5>--}}
{{--                                    <p>Marshmallow biscuit donut dragée fruitcake. Jujubes wafer cupcake.--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-12 col-md-4 mb-4 mb-md-0">--}}
{{--                                <div class="w-75 mx-auto">--}}
{{--                                    <i class="feather icon-shield text-primary font-large-2"></i>--}}
{{--                                    <h5 class="mt-2 font-weight-bold">1 Year Warranty</h5>--}}
{{--                                    <p>Cotton candy gingerbread cake I love sugar plum I love sweet croissant.--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="mt-4 mb-2 text-center">--}}
{{--                            <h2>RELATED PRODUCTS</h2>--}}
{{--                            <p>People also search for this items</p>--}}
{{--                        </div>--}}
{{--                        <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">--}}
{{--                            <div class="swiper-wrapper">--}}
{{--                                <div class="swiper-slide rounded swiper-shadow">--}}
{{--                                    <div class="item-heading">--}}
{{--                                        <p class="text-truncate mb-0">--}}
{{--                                            Bowers Wilkins - CM10 S2 Triple 6-1/2" 3-Way Floorstanding Speaker (Each) - Gloss Black--}}
{{--                                        </p>--}}
{{--                                        <p>--}}
{{--                                            <small>by</small>--}}
{{--                                            <small>Bowers & Wilkins</small>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                    <div class="img-container w-50 mx-auto my-2 py-75">--}}
{{--                                        <img src="../../../app-assets/images/elements/apple-watch.png" class="img-fluid" alt="image">--}}
{{--                                    </div>--}}
{{--                                    <div class="item-meta">--}}
{{--                                        <div class="product-rating">--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-secondary"></i>--}}
{{--                                        </div>--}}
{{--                                        <p class="text-primary mb-0">$19.98</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="swiper-slide rounded swiper-shadow">--}}
{{--                                    <div class="item-heading">--}}
{{--                                        <p class="text-truncate mb-0">--}}
{{--                                            Alienware - 17.3" Laptop - Intel Core i7 - 16GB Memory - NVIDIA GeForce GTX 1070 - 1TB Hard Drive +--}}
{{--                                            128GB Solid State Drive - Silver--}}
{{--                                        </p>--}}
{{--                                        <p>--}}
{{--                                            <small>by</small>--}}
{{--                                            <small>Alienware</small>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                    <div class="img-container w-50 mx-auto my-2 py-75">--}}
{{--                                        <img src="../../../app-assets/images/elements/beats-headphones.png" class="img-fluid" alt="image">--}}
{{--                                    </div>--}}
{{--                                    <div class="item-meta">--}}
{{--                                        <div class="product-rating">--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-secondary"></i>--}}
{{--                                        </div>--}}
{{--                                        <p class="text-primary mb-0">$35.98</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="swiper-slide rounded swiper-shadow">--}}
{{--                                    <div class="item-heading">--}}
{{--                                        <p class="text-truncate mb-0">--}}
{{--                                            Canon - EOS 5D Mark IV DSLR Camera with 24-70mm f/4L IS USM Lens--}}
{{--                                        </p>--}}
{{--                                        <p>--}}
{{--                                            <small>by</small>--}}
{{--                                            <small>Canon</small>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                    <div class="img-container w-50 mx-auto my-3 py-50">--}}
{{--                                        <img src="../../../app-assets/images/elements/macbook-pro.png" class="img-fluid" alt="image">--}}
{{--                                    </div>--}}
{{--                                    <div class="item-meta">--}}
{{--                                        <div class="product-rating">--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-secondary"></i>--}}
{{--                                        </div>--}}
{{--                                        <p class="text-primary mb-0">$49.98</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="swiper-slide rounded swiper-shadow">--}}
{{--                                    <div class="item-heading">--}}
{{--                                        <p class="text-truncate mb-0">--}}
{{--                                            Apple - 27" iMac with Retina 5K display - Intel Core i7 - 32GB Memory - 2TB Fusion Drive - Silver--}}
{{--                                        </p>--}}
{{--                                        <p>--}}
{{--                                            <small>by</small>--}}
{{--                                            <small>Apple</small>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                    <div class="img-container w-50 mx-auto my-2 py-75">--}}
{{--                                        <img src="../../../app-assets/images/elements/homepod.png" class="img-fluid" alt="image">--}}
{{--                                    </div>--}}
{{--                                    <div class="item-meta">--}}
{{--                                        <div class="product-rating">--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-secondary"></i>--}}
{{--                                        </div>--}}
{{--                                        <p class="text-primary mb-0">$29.98</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="swiper-slide rounded swiper-shadow">--}}
{{--                                    <div class="item-heading">--}}
{{--                                        <p class="text-truncate mb-0">--}}
{{--                                            Bowers Wilkins - CM10 S2 Triple 6-1/2" 3-Way Floorstanding Speaker (Each) - Gloss Black--}}
{{--                                        </p>--}}
{{--                                        <p>--}}
{{--                                            <small>by</small>--}}
{{--                                            <small>Bowers & Wilkins</small>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                    <div class="img-container w-50 mx-auto my-2 py-75">--}}
{{--                                        <img src="../../../app-assets/images/elements/magic-mouse.png" class="img-fluid" alt="image">--}}
{{--                                    </div>--}}
{{--                                    <div class="item-meta">--}}
{{--                                        <div class="product-rating">--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-secondary"></i>--}}
{{--                                        </div>--}}
{{--                                        <p class="text-primary mb-0">$99.98</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="swiper-slide rounded swiper-shadow">--}}
{{--                                    <div class="item-heading">--}}
{{--                                        <p class="text-truncate mb-0">--}}
{{--                                            Garmin - fenix 3 Sapphire GPS Watch - Silver--}}
{{--                                        </p>--}}
{{--                                        <p>--}}
{{--                                            <small>by</small>--}}
{{--                                            <small>Garmin</small>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                    <div class="img-container w-50 mx-auto my-2 py-75">--}}
{{--                                        <img src="../../../app-assets/images/elements/iphone-x.png" class="img-fluid" alt="image">--}}
{{--                                    </div>--}}
{{--                                    <div class="item-meta">--}}
{{--                                        <div class="product-rating">--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-warning"></i>--}}
{{--                                            <i class="feather icon-star text-secondary"></i>--}}
{{--                                        </div>--}}
{{--                                        <p class="text-primary mb-0">$59.98</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- Add Arrows -->--}}
{{--                            <div class="swiper-button-next"></div>--}}
{{--                            <div class="swiper-button-prev"></div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
                    {{--////////////////////////////////////////////////// --}}
                    <!-- account end -->
                    <!-- information start -->
{{----}}
{{-- <!-- static data -->--}}
 <div class="col-md-6 col-12 ">
     <div class="card">
         <div class="card-header">
             <div class="card-title mb-2">Information</div>
         </div>
         <div class="card-body">
             <table>
                 <tr>
                     <td class="font-weight-bold">Birth Date </td>
                     <td>28 January 1998
                     </td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">Mobile</td>
                     <td>+65958951757</td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">Website</td>
                     <td>https://rowboat.com/insititious/Angelo
                     </td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">Languages</td>
                     <td>English, Arabic
                     </td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">Gender</td>
                     <td>female</td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">Contact</td>
                     <td>email, message, phone
                     </td>
                 </tr>
             </table>
         </div>
     </div>
 </div>
{{-- <!-- information start -->--}}
{{-- <!-- social links end -->--}}
 <div class="col-md-6 col-12 ">
     <div class="card">
         <div class="card-header">
             <div class="card-title mb-2">Social Links</div>
         </div>
         <div class="card-body">
             <table>
                 <tr>
                     <td class="font-weight-bold">Twitter</td>
                     <td>https://twitter.com/adoptionism744
                     </td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">Facebook</td>
                     <td>https://www.facebook.com/adoptionism664
                     </td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">Instagram</td>
                     <td>https://www.instagram.com/adopt-ionism744/
                     </td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">Github</td>
                     <td>https://github.com/madop818
                     </td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">CodePen</td>
                     <td>https://codepen.io/adoptism243
                     </td>
                 </tr>
                 <tr>
                     <td class="font-weight-bold">Slack</td>
                     <td>@adoptionism744
                     </td>
                 </tr>
             </table>
         </div>
     </div>
 </div>
{{-- <!-- social links end -->--}}

{{-- <!-- permissions start -->--}}

 <div class="col-12">
     <div class="card">
         <div class="card-header border-bottom mx-2 px-0">
             <h6 class="border-bottom py-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>Permission
             </h6>
         </div>
         <div class="card-body px-75">
             <div class="table-responsive users-view-permission">
                 <table class="table table-borderless">
                     <thead>
                     <tr>
                         <th>Module</th>
                         <th>Read</th>
                         <th>Write</th>
                         <th>Create</th>
                         <th>Delete</th>
                     </tr>
                     </thead>
                     <tbody>
                     <tr>
                         <td>Users</td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox1" class="custom-control-input" disabled checked>
                                 <label class="custom-control-label" for="users-checkbox1"></label>
                             </div>
                         </td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox2" class="custom-control-input" disabled><label class="custom-control-label" for="users-checkbox2"></label>
                             </div>
                         </td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox3" class="custom-control-input" disabled><label class="custom-control-label" for="users-checkbox3"></label>
                             </div>
                         </td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox4" class="custom-control-input" disabled checked>
                                 <label class="custom-control-label" for="users-checkbox4"></label>
                             </div>
                         </td>
                     </tr>
                     <tr>
                         <td>Articles</td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox5" class="custom-control-input" disabled><label class="custom-control-label" for="users-checkbox5"></label>
                             </div>
                         </td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox6" class="custom-control-input" disabled checked>
                                 <label class="custom-control-label" for="users-checkbox6"></label>
                             </div>
                         </td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox7" class="custom-control-input" disabled><label class="custom-control-label" for="users-checkbox7"></label>
                             </div>
                         </td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox8" class="custom-control-input" disabled checked>
                                 <label class="custom-control-label" for="users-checkbox8"></label>
                             </div>
                         </td>
                     </tr>
                     <tr>
                         <td>Staff</td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox9" class="custom-control-input" disabled checked>
                                 <label class="custom-control-label" for="users-checkbox9"></label>
                             </div>
                         </td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox10" class="custom-control-input" disabled checked>
                                 <label class="custom-control-label" for="users-checkbox10"></label>
                             </div>
                         </td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox11" class="custom-control-input" disabled><label class="custom-control-label" for="users-checkbox11"></label>
                             </div>
                         </td>
                         <td>
                             <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox12" class="custom-control-input" disabled><label class="custom-control-label" for="users-checkbox12"></label>
                             </div>
                         </td>
                     </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>
 <!-- permissions end -->
</div>
</section>
<!-- page users view end -->

</div>
</div>
</div>
<!-- END: Content-->
</x-dashboard.layouts.master>
