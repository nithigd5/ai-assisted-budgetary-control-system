@extends('layouts.app')


@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Budget Card -->
                    <div class="col-xxl-4 col-md-6">
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
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$2,264</h6>
                                        <span class="text-success small pt-1 fw-bold">12%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Budget Card -->

                    <!-- Spent Card -->
                    <div class="col-xxl-4 col-md-6">
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
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$3,264</h6>
                                        <span class="text-success small pt-1 fw-bold">8%</span> <span
                                            class="text-muted small pt-2 ps-1">increase</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- End Spent Card -->

                    <!-- Add Expense Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Add Expense <span>| Today</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cash-stack"></i>
                                    </div>
                                    <div class="ps-3">
                                        <button data-bs-toggle="modal" data-bs-target="#add-expense" type="button" class="btn btn-primary">Add Expense</button>
                                        <button type="button" id="speak-expense" class="btn btn-primary" data-listening="false"><i class="bi bi-mic-fill"></i></button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- End Friends Card -->


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
                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Budget',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'Expense',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            },],
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
                                                categories: ["2023-03-19T00:00:00.000Z", "2023-03-20T01:30:00.000Z", "2023-03-21T02:30:00.000Z", "2023-03-22T03:30:00.000Z", "2023-03-23T04:30:00.000Z", "2023-03-24T05:30:00.000Z", "2023-03-25T06:30:00.000Z"]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
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
                                    <tr>
                                        <th scope="row"><a href="#">#2457</a></th>
                                        <td><a href="#" class="text-primary">Sambar Powder</a></td>
                                        <td>$64</td>
                                        <td><span class="badge bg-warning text-dark">Cash</span></td>
                                        <td><span class="badge bg-success text-white"><i class="bi bi-emoji-neutral-fill me-1"></i>Ok</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2147</a></th>
                                        <td><a href="#" class="text-primary">Puliyogare Paste</a></td>
                                        <td>$47</td>
                                        <td><span class="badge bg-info text-white">Google Pay</span></td>
                                        <td><span class="badge bg-success text-white"><i class="bi bi-emoji-neutral-fill me-1"></i>Ok</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2049</a></th>
                                        <td><a href="#" class="text-primary">Masala Dosa Batter</a></td>
                                        <td>$147</td>
                                        <td><span class="badge bg-danger text-white">Credit Card</span></td>
                                        <td><span class="badge bg-success text-white"><i class="bi bi-emoji-neutral-fill me-1"></i>Ok</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2644</a></th>
                                        <td><a href="#" class="text-primary">Rasam Powder</a></td>
                                        <td>$67</td>
                                        <td><span class="badge bg-success text-white">Debit Card</span></td>
                                        <td><span class="badge bg-success text-white"><i class="bi bi-emoji-smile-fill me-1"></i>Happy</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2644</a></th>
                                        <td><a href="#" class="text-primary">Mysore Silk Saree</a></td>
                                        <td>$165</td>
                                        <td><span class="badge bg-primary text-white">PhonePe</span></td>
                                        <td><span class="badge bg-success text-white"><i class="bi bi-emoji-smile-fill me-1"></i>Happy</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2458</a></th>
                                        <td><a href="#" class="text-primary">Madras Coffee Powder</a></td>
                                        <td>$50</td>
                                        <td><span class="badge bg-warning text-dark">Cash</span></td>
                                        <td><span class="badge bg-danger text-white"><i class="bi bi-emoji-heart-eyes-fill me-1"></i>Sad</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2148</a></th>
                                        <td><a href="#" class="text-primary">Paniyaram Pan</a></td>
                                        <td>$20</td>
                                        <td><span class="badge bg-info text-white">Paytm</span></td>
                                        <td><span class="badge bg-danger text-white"><i class="bi bi-emoji-heart-eyes-fill me-1"></i>Sad</span></td>
                                    </tr>
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
            </div><!-- End Left side columns -->

        </div>
    </section>

    <div class="modal fade" id="add-expense" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('tickets.store') }}" method="POST" novalidate="">
                        @csrf
                        <div class="col-12 position-relative">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                                   value="{{ old('title') }}">

                            <div class="invalid-tooltip">
                                @error('title') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="col-12 position-relative">
                            <label for="message" class="form-label @error('message') is-invalid @enderror">Description</label>
                            <textarea rows="4" class="form-control" id="message" name="message">{{ old('description') }}</textarea>
                            <div class="invalid-tooltip">
                                @error('message') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="col-12 position-relative">
                            <label for="priority" class="form-label">Priority</label>
                            <select type="text" class="form-control @error('priority') is-invalid @enderror" name="priority" id="priority" required="">
                                <option value="low">Low</option>
                                <option value="normal">Normal</option>
                                <option value="high">High</option>
                            </select>
                            <div class="invalid-tooltip">
                                @error('priority') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" id="category"
                                   value="{{ old('category') }}">

                            <div class="invalid-tooltip">
                                @error('title') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="col-12 position-relative">
                            <label for="label" class="form-label">Label</label>
                            <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" id="label"
                                   value="{{ old('label') }}">

                            <div class="invalid-tooltip">
                                @error('title') {{ $message }} @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#speak-expense").on('click', function (){

            var speechBtn = $(this)

            // new speech recognition object
            var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
            var recognition = new SpeechRecognition();

            // This runs when the speech recognition service starts
            recognition.onstart = function() {
                speechBtn.data('listening', true)
                speechBtn.html('<i class="bi bi-stop-circle-fill"></i>');
            };

            recognition.onspeechend = function() {
                // when user is done speaking
                speechBtn.html('<i class="bi bi-mic-fill"></i>')
                speechBtn.data('listening', false)
                recognition.stop();
            }

            // This runs when the speech recognition service returns result
            recognition.onresult = function(event) {
                let transcript = event.results[0][0].transcript;
                let confidence = event.results[0][0].confidence;

                extractData(transcript)
            };

            if(speechBtn.data('listening'))
            {
                recognition.stop();
            }else{
                recognition.start();
            }
        })

        function extractData(text)
        {
            console.log(text)
            $.ajax({
                url: '{{ route('nlp.extract') }}',
                method: 'POST',
                data: {text},
                success: function (res){
                    console.log(res)
                },
                error: function (res){
                    console.log(res)
                }
            });
        }
    </script>
@endsection
