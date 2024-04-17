<x-front-layout title="Home">

    <x-alert type="info"/>
    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">
                        <!-- Start Single Widget -->
                        <div class="single-widget search">
                            <h3>Search Product</h3>
                            <form action="{{ route('front.products.index') }}" id="search" method="get">
                                <input id="searchInput" type="text" name="filter[name][]" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>

                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <?php
                        $categoriesWithSubcategories = \App\Helpers\Categoray::getCategoriesWithSubcategories();
                        ?>
                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <ul class="list">
                                @foreach($categoriesWithSubcategories as $category)
                                <li>
                                    <a href="{{route('front.products.index')}}?filter[category.slug]={{ $category->slug }}">{{$category->name}}</a><span>({{$category['products']->count()}})</span>
                                </li>
                                    @endforeach

                            </ul>
                        </div>
                        <!-- End Single Widget -->


                    </div>
                    <!-- End Product Sidebar -->
                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">
                                            <label for="sorting">Sort by:</label>
                                            <select class="form-control" id="sorting">
                                                <option value="price">Select</option>
                                                <option value="price">Low - High Price</option>
                                                <option value="-price">High - Low Price</option>
                                                <option value="name">A - Z Order</option>
                                                <option value="-name">Z - A Order</option>
                                            </select>
                                        <h3 class="total-show-product">Showing: <span>{{ $products->firstItem() }} - {{ $products->lastItem() }} items</span></h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-grid" type="button" role="tab"
                                                    aria-controls="nav-grid" aria-selected="true"><i
                                                    class="lni lni-grid-alt"></i></button>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                 aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    @foreach($products as $product)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <!-- Start Single Product -->
                                        <div class="single-product">
                                            <div class="product-image">
                                                <img src="{{ $product->image_url }}" alt="#">
                                                <div class="button">
                                                    <a href="{{route('front.products.show',$product,$product->sulg)}}" class="btn"><i
                                                            class="lni lni-cart"></i> Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <span class="category">{{ $product['category']->name }}</span>
                                                <h4 class="title">
                                                    <p >{{$product->name}}</p>
                                                </h4>

                                                <div class="price">
                                                    <span>${{$product->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Product -->
                                    </div>
                                    @endforeach

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Pagination -->
                                        <div class="pagination left">
                                            <ul class="pagination-list">
                                                @if ($products->onFirstPage())
                                                    <li class="disabled"><a href="javascript:void(0)">← Previous</a></li>
                                                @else
                                                    <li><a href="{{ $products->previousPageUrl() }}" rel="prev">← Previous</a></li>
                                                @endif

                                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                                    <li class="{{ $i === $products->currentPage() ? 'active' : '' }}">
                                                        <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor

                                                @if ($products->hasMorePages())
                                                    <li><a href="{{ $products->nextPageUrl() }}" rel="next">Next →</a></li>
                                                @else
                                                    <li class="disabled"><a href="javascript:void(0)">Next →</a></li>
                                                @endif
                                            </ul>

                                        </div>
                                        <!--/ End Pagination -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Grids -->



</x-front-layout>
<!-- Add this script to your Blade template -->
<!-- Add this script to your Blade template -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to update sorting option
        $('#sorting').change(function() {
            var sortingOption = $(this).val();
            updateUrlParameter('sort', sortingOption);
        });

        // Function to add filter input
        $('#addFilter').click(function() {
            $('#filterInputs').append('<input type="text" name="filter[name][]" placeholder="Search Here...">');
        });

        // Function to handle form submission
        $('#search').submit(function(event) {
            event.preventDefault();
            var filterValues = getFilterValues();
            updateUrlParameter('filter[name][]', filterValues);
        });

        // Function to get filter values
        function getFilterValues() {
            var filterValues = [];
            $('input[name="filter[name][]"]').each(function() {
                filterValues.push($(this).val());
            });
            return filterValues;
        }

        // Function to update URL parameter
        function updateUrlParameter(paramName, paramValue) {
            var baseUrl = window.location.href.split('?')[0];
            var queryParams = getQueryParameters();
            queryParams[paramName] = paramValue;
            var updatedUrl = baseUrl + '?' + $.param(queryParams);
            window.location.href = updatedUrl;
        }

        // Function to get query parameters as an object
        function getQueryParameters() {
            var queryParams = {};
            window.location.search.substring(1).split('&').forEach(function(queryParam) {
                var keyValue = queryParam.split('=');
                queryParams[keyValue[0]] = keyValue[1];
            });
            return queryParams;
        }
    });
</script>


