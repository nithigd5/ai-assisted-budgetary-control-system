@extends('layouts.app')

@php
    $budget = $budget ?? null;
@endphp

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success !</strong> {{session()->get('success')}}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div><!-- End Page Title -->     sulaiman
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-8">
                <div class="row">
                    <!-- Budget Card -->
                    <div class="col-lg-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Budget <span>| This Month</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$2,264</h6>
                                        {{--                                        <span class="text-success small pt-1 fw-bold">12%</span> <span--}}
                                        {{--                                            class="text-muted small pt-2 ps-1">increase</span>--}}

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Budget Card -->

                    <div class="col-lg-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Expense <span>| This Month</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>${{ $totalExpenses }}</h6>
                                        <span class="text-success small pt-1 fw-bold">8%</span> <span
                                            class="text-muted small pt-2 ps-1">Decrease</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Spent Card -->

                    <div class="col-lg-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Update/Add Budget <span>of this Month</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    <div class="ps-3">
                                        <button data-bs-toggle="modal" data-bs-target="#set-budget" type="button"
                                                class="btn btn-primary">Update/Add Budget
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- End Friends Card -->

                    <div class="col-lg-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Add Expense <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    <div class="ps-3">
                                        <button data-bs-toggle="modal" data-bs-target="#add-expense" type="button"
                                                class="btn btn-primary">Add Expense
                                        </button>
                                        <button type="button" id="speak-expense" class="btn btn-primary"
                                                data-listening="false"><i class="bi bi-mic-fill"></i></button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- End Friends Card -->

                    <!-- Spent Card -->

                    <!-- Add Expense Card -->

                </div>
            </div><!-- End Left side columns -->

            <div class="col-4">
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="#">March</a></li>
                            <li><a class="dropdown-item" href="#">April</a></li>
                            <li><a class="dropdown-item" href="#">May</a></li>
                            <li><a class="dropdown-item" href="#">June</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Budget <span>| Month</span></h5>

                        <div id="trafficChart"
                             style="min-height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); position: relative;"
                             class="echart" _echarts_instance_="ec_1683732659126">
                            <div
                                style="position: relative; width: 723px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                <canvas data-zr-dom-id="zr_0" width="903" height="500"
                                        style="position: absolute; left: 0px; top: 0px; width: 723px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                            </div>
                            <div class=""
                                 style="position: absolute; display: block; border-style: solid; white-space: nowrap; z-index: 9999999; box-shadow: rgba(0, 0, 0, 0.2) 1px 2px 10px; transition: opacity 0.2s cubic-bezier(0.23, 1, 0.32, 1) 0s, visibility 0.2s cubic-bezier(0.23, 1, 0.32, 1) 0s, transform 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s; background-color: rgb(255, 255, 255); border-width: 1px; border-radius: 4px; color: rgb(102, 102, 102); font: 14px / 21px &quot;Microsoft YaHei&quot;; padding: 10px; top: 0px; left: 0px; transform: translate3d(488px, 131px, 0px); border-color: rgb(84, 112, 198); pointer-events: none; visibility: hidden; opacity: 0;">
                                <div style="margin: 0px 0 0;line-height:1;">
                                    <div style="font-size:14px;color:#666;font-weight:400;line-height:1;">Access From
                                    </div>
                                    <div style="margin: 10px 0 0;line-height:1;">
                                        <div style="margin: 0px 0 0;line-height:1;"><span
                                                style="display:inline-block;margin-right:4px;border-radius:10px;width:10px;height:10px;background-color:#5470c6;"></span><span
                                                style="font-size:14px;color:#666;font-weight:400;margin-left:2px">Search Engine</span><span
                                                style="float:right;margin-left:20px;font-size:14px;color:#666;font-weight:900">1,048</span>
                                            <div style="clear:both"></div>
                                        </div>
                                        <div style="clear:both"></div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Budget',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [
                                            {
                                                value: {{ $budget?->food ?? 0 }},
                                                name: 'Food'
                                            },
                                            {
                                                value: {{ $budget?->clothing ?? 0 }},
                                                name: 'Clothing'
                                            },
                                            {
                                                value: {{ $budget?->education ?? 0 }},
                                                name: 'Education'
                                            },
                                            {
                                                value: {{ $budget?->debts ?? 0 }},
                                                name: 'Debts'
                                            },
                                            {
                                                value: {{ $budget?->mobile ?? 0 }},
                                                name: 'Mobile'
                                            },
                                            {
                                                value: {{ $budget?->other ?? 0 }},
                                                name: 'Other'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div>

            </div>

            <!-- Reports -->
            <div class="col-12">
                <div class="card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Estimated Budget Reports <span>/This Month</span></h5>

                        <!-- Line Chart -->
                        <div id="reportsChart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#reportsChart"), {
                                    series: [
                                        {
                                        name: 'Budget',
                                        data: {!! json_encode($expenseBudgetDataSet->pluck('actual_budget')->toArray()) !!},
                                    },
                                        {
                                        name: 'Predicted Budget',
                                        data: {!! json_encode($expenseBudgetDataSet->pluck('predicted_budget')->toArray()) !!},
                                    },
                                        {
                                        name: 'Predicted Expense',
                                        data: {!! json_encode($expenseBudgetDataSet->pluck('predicted_expense')->toArray()) !!},
                                    },
                                        {
                                        name: 'Expense',
                                        data: {!! json_encode($expenseBudgetDataSet->pluck('expense')->toArray()) !!},
                                    },
                                    ],
                                    chart: {
                                        height: 350,
                                        type: 'area',
                                        toolbar: {
                                            show: false
                                        },
                                    },
                                    markers: {
                                        size: 4
                                    },
                                    colors: ['#4154f1', '#2eca6a'],
                                    fill: {
                                        type: "gradient",
                                        gradient: {
                                            shadeIntensity: 1,
                                            opacityFrom: 0.3,
                                            opacityTo: 0.4,
                                            stops: [0, 90, 100]
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        curve: 'smooth',
                                        width: 2
                                    },
                                    xaxis: {
                                        type: 'datetime',
                                        categories: {!!   json_encode($expenseBudgetDataSet->pluck('created_at')->map(fn($date) => $date->toFormattedDateString())->toArray()) !!}
                                    },
                                    tooltip: {
                                        x: {
                                            format: 'dd/MM/yy'
                                        },
                                    }
                                }).render();
                            });
                        </script>
                        <!-- End Line Chart -->

                    </div>

                </div>
            </div><!-- End Reports -->

            <!-- Recent Purchase -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Recent Purchase <span>| This Month</span></h5>

                        <table class="table table-borderless datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Mode of Payment</th>
                                <th scope="col">Mood</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <th scope="row"><a href="#">#{{ $expense->id }}</a></th>
                                    <td><a href="#" class="text-primary">{{ $expense->product->name }}</a></td>
                                    <td>₹{{ $expense->price }}</td>
                                    <td><span class="badge bg-warning text-dark">{{ $expense->mode }}</span>
                                    </td>
                                    <td>
                                        @if($expense->sentiment == 'Positive')
                                            <span class="badge bg-success text-white"><i
                                                    class="bi bi-emoji-smile-fill me-1"></i>{{ $expense->sentiment }}</span>
                                        @elseif($expense->sentiment == 'Negative')
                                            <span class="badge bg-danger text-white"><i
                                                    class="bi bi-emoji-angry-fill me-1"></i>{{ $expense->sentiment }}</span>
                                        @else
                                            <span class="badge bg-primary text-white"><i
                                                    class="bi bi-emoji-neutral-fill me-1"></i>{{ $expense->sentiment ?? 'Neutral'}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Purchase -->

            <!-- Top Alternatives -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Top Alternatives<span>| Today</span></h5>

                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th scope="col">Preview</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                                <td><a href="#" class="text-primary fw-bold">Shoe</a></td>
                                <td>$5</td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#"><img src="assets/img/product-2.jpg" alt=""></a></th>
                                <td><a href="#" class="text-primary fw-bold">Watch</a></td>
                                <td>$4</td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#"><img src="assets/img/product-3.jpg" alt=""></a></th>
                                <td><a href="#" class="text-primary fw-bold">Shampoo</a></td>
                                <td>$6</td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#"><img src="assets/img/product-4.jpg" alt=""></a></th>
                                <td><a href="#" class="text-primary fw-bold">Coolers</a></td>
                                <td>$3</td>
                            </tr>
                            <tr>
                                <th scope="row"><a href="#"><img src="assets/img/product-5.jpg" alt=""></a></th>
                                <td><a href="#" class="text-primary fw-bold">Headphone</a></td>
                                <td>$100</td>
                            </tr>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Top Selling -->
        </div>
    </section>

    <div class="modal fade" id="add-expense" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="expense-form" class="row g-3" action="{{ route('expense.store') }}" method="POST">
                        @csrf
                        <div class="col-12 position-relative">
                            <label for="product" class="form-label">
                                Name
                                <button type="button" class="ms-1 btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#productModal">
                                    Add Product
                                </button>
                            </label>
                            <select required class="products-select2 form-select @error('product') is-invalid @enderror"
                                    name="product" id="product">
                                <option>Select An Option</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">
                                @error('product') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="price" class="form-label">Price</label>
                            <input required type="number" class="form-control @error('price') is-invalid @enderror"
                                   name="price" id="price"
                                   value="{{ old('price') }}">

                            <div class="invalid-tooltip">
                                @error('price') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="mode" class="form-label">Mode</label>
                            <input required type="text" class="form-control @error('mode') is-invalid @enderror"
                                   name="mode" id="mode"
                                   value="{{ old('mode') }}">

                            <div class="invalid-tooltip">
                                @error('mode') {{ $message }} @enderror
                            </div>
                        </div>


                        <div class="col-12 position-relative">
                            <label for="feedback" class="form-label">Feedback</label>
                            <input required type="text" class="form-control @error('feedback') is-invalid @enderror"
                                   name="feedback" id="feedback"
                                   value="{{ old('feedback') }}">

                            <div class="invalid-tooltip">
                                @error('feedback') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="set-budget" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update/Add Current Month Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="budget-form" class="row g-3" action="{{ route('budgets.store') }}" method="POST">
                        @csrf
                        <div class="col-12 position-relative">
                            <label for="food" class="form-label">Food</label>
                            <input required type="number" class="form-control @error('food') is-invalid @enderror"
                                   name="food" id="food"
                                   value="{{ old('food', $budget?->food) }}">

                            <div class="invalid-tooltip">
                                @error('food') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="education" class="form-label">Education</label>
                            <input required type="number" class="form-control @error('education') is-invalid @enderror"
                                   name="education" id="education"
                                   value="{{ old('education', $budget?->education) }}">

                            <div class="invalid-tooltip">
                                @error('education') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="debts" class="form-label">Debts</label>
                            <input required type="number" class="form-control @error('debts') is-invalid @enderror"
                                   name="debts" id="debts"
                                   value="{{ old('debts', $budget?->debts) }}">

                            <div class="invalid-tooltip">
                                @error('debts') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="clothing" class="form-label">Clothing</label>
                            <input required type="number" class="form-control @error('clothing') is-invalid @enderror"
                                   name="clothing" id="clothing"
                                   value="{{ old('clothing', $budget?->clothing) }}">

                            <div class="invalid-tooltip">
                                @error('clothing') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input required type="number" class="form-control @error('mobile') is-invalid @enderror"
                                   name="mobile" id="mobile"
                                   value="{{ old('mobile', $budget?->mobile) }}">

                            <div class="invalid-tooltip">
                                @error('mobile') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="other" class="form-label">Other</label>
                            <input required type="number" class="form-control @error('other') is-invalid @enderror"
                                   name="other" id="other"
                                   value="{{ old('other', $budget?->other) }}">

                            <div class="invalid-tooltip">
                                @error('other') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="expense-form" class="row g-3" action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="col-12 position-relative">
                            <label for="price" class="form-label">Name</label>
                            <input required type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" id="name"
                                   value="{{ old('name') }}">

                            <div class="invalid-tooltip">
                                @error('name') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="price" class="form-label">Description</label>
                            <input required type="text" class="form-control @error('description') is-invalid @enderror"
                                   name="description" id="description"
                                   value="{{ old('description') }}">

                            <div class="invalid-tooltip">
                                @error('description') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="mode" class="form-label">Category</label>
                            <input required type="text" class="form-control @error('category') is-invalid @enderror"
                                   name="category" id="category"
                                   value="{{ old('category') }}">

                            <div class="invalid-tooltip">
                                @error('category') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="type" class="form-label">Type</label>
                            <input required type="text" class="form-control @error('type') is-invalid @enderror"
                                   name="type" id="type"
                                   value="{{ old('type') }}">

                            <div class="invalid-tooltip">
                                @error('type') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="min_price" class="form-label">Min Price</label>
                            <input required type="number" class="form-control @error('min_price') is-invalid @enderror"
                                   name="min_price" id="min_price"
                                   value="{{ old('min_price') }}">

                            <div class="invalid-tooltip">
                                @error('min_price') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="max_price" class="form-label">Max Price</label>
                            <input required type="text" class="form-control @error('max_price') is-invalid @enderror"
                                   name="max_price" id="max_price"
                                   value="{{ old('max_price') }}">

                            <div class="invalid-tooltip">
                                @error('max_price') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="feedback" class="form-label">Brand</label>
                            <input required type="text" class="form-control @error('brand') is-invalid @enderror"
                                   name="brand" id="brand"
                                   value="{{ old('brand') }}">

                            <div class="invalid-tooltip">
                                @error('brand') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('.products-select2').select2({
                    dropdownParent: $('#add-expense'),
                    width: '100%',
                });

                $('form').submit(function (e) {
                    // e.preventDefault();
                    console.log("Hello");
                });
            });

            $("#speak-expense").on('click', function () {

                var speechBtn = $(this)

                // new speech recognition object
                var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
                var recognition = new SpeechRecognition();

                // This runs when the speech recognition service starts
                recognition.onstart = function () {
                    speechBtn.data('listening', true)
                    speechBtn.html('<i class="bi bi-stop-circle-fill"></i>');
                };

                recognition.onspeechend = function () {
                    // when user is done speaking
                    speechBtn.html('<i class="bi bi-mic-fill"></i>')
                    speechBtn.data('listening', false)
                    recognition.stop();
                }

                // This runs when the speech recognition service returns result
                recognition.onresult = function (event) {
                    let transcript = event.results[0][0].transcript;
                    let confidence = event.results[0][0].confidence;

                    extractData(transcript)
                };

                recognition.start();

            })

            function extractData(text) {
                console.log(text)
                $.ajax({
                    url: '{{ route('nlp.extract') }}',
                    method: 'POST',
                    data: {text},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        console.log(res)

                        if (res.product)

                            $("#product").val(res.product)
                        $("#price").val(res.price)
                        $("#mode").val(res.mode)
                        $("#feedback").val(text)
                        $("#feedback").attr('type', 'hidden').parent().hide()
                        $("#add-expense").modal('show')
                    },
                    error: function (res) {
                        console.log(res)
                    }
                });
            }
        </script>
    @endpush

@endsection
