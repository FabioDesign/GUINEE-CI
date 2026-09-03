@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body py-4">
        <div class="row mb-5">
            <div class="col-md-4 col-12">
                <label class="fw-bolder text-dark fs-5">Documents : <span class="text-danger">*</span></label>
                <select id="documents" class="form-select">
                    <option value="" selected>Tous les documents</option>
                    @foreach($documents as $data)
                        <option value="{{ $data->document_id }}">{{ optional($data->document)->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-12">
                <label class="fw-bolder text-dark fs-5">Date de début :</label>
                <input type="text" id="start_date_stats" value="{{ date('Y-m-d') }}" class="form-control date_at" readonly>
            </div>
            <div class="col-md-3 col-12">
                <label class="fw-bolder text-dark fs-5">Date de fin :</label>
                <input type="text" id="end_date_stats" value="{{ date('Y-m-d') }}" class="form-control date_at" readonly>
            </div>
            <div class="col-md-2 col-12">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-success font-weight-bold fs-4 px-6 py-3 submitStats">Rechercher</button>
            </div>
        </div>
    </div>
</div>
<div class="row mt-10">
    <div class="col-md-3 col-12">
    <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10 h-175px" style="background-color: #7239EA;background-image:url('assets/img/bg-purple.svg')">
            <!--begin::Header-->
            <div id="amount" class="card-header py-10 fs-2hx fw-bold text-white m-auto px-0">0</div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mb-2">
                        <span class="m-auto">Montant total</span>
                    </div>
                    <div class="h-10px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-10px" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 20-->
    </div>
    <div class="col-md-3 col-12">
    <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10 h-175px" style="background-color: #F1416C;background-image:url('/assets/img/bg-red.png')">
            <!--begin::Header-->
            <div id="paid" class="card-header py-10 fs-2hx fw-bold text-white m-auto px-0">0</div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mb-2">
                        <span class="m-auto">Documents payés</span>
                    </div>
                    <div class="h-10px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-10px" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 20-->
    </div>
    <div class="col-md-3 col-12">
    <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10 h-175px" style="background: linear-gradient(112.14deg, #FF8A00 0%, #E96922 100%)">
            <!--begin::Header-->
            <div id="free" class="card-header py-10 fs-2hx fw-bold text-white m-auto px-0">0</div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mb-2">
                        <span class="m-auto">Documents gratuits</span>
                    </div>
                    <div class="h-10px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-10px" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 20-->
    </div>
    <div class="col-md-3 col-12">
    <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-cover bgi-position-x-end mb-5 mb-xl-10 h-175px" style="background-image:url('/assets/img/bg-green.png')">
            <!--begin::Header-->
            <div id="recovered" class="card-header py-10 fs-2hx fw-bold text-white m-auto px-0">0</div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mb-2">
                        <span class="m-auto">Documents récupérés</span>
                    </div>
                    <div class="h-10px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-10px" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 20-->
    </div>
</div>
<div class="row mb-5">
    <div class="col-md-3 col-12">
    <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10 h-175px" style="background-color: #7239EA;background-image:url('assets/img/bg-purple.svg')">
            <!--begin::Header-->
            <div id="validated" class="card-header py-10 fs-2hx fw-bold text-white m-auto px-0">0</div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mb-2">
                        <span class="m-auto">Documents validés</span>
                    </div>
                    <div class="h-10px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-10px" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 20-->
    </div>
    <div class="col-md-3 col-12">
    <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10 h-175px" style="background-color: #F1416C;background-image:url('/assets/img/bg-red.png')">
            <!--begin::Header-->
            <div id="rejected" class="card-header py-10 fs-2hx fw-bold text-white m-auto px-0">0</div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mb-2">
                        <span class="m-auto">Documents rejetés</span>
                    </div>
                    <div class="h-10px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-10px" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 20-->
    </div>
    <div class="col-md-3 col-12">
    <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10 h-175px" style="background: linear-gradient(112.14deg, #FF8A00 0%, #E96922 100%)">
            <!--begin::Header-->
            <div id="transmitted" class="card-header py-10 fs-2hx fw-bold text-white m-auto px-0">0</div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mb-2">
                        <span class="m-auto">Documents transmis</span>
                    </div>
                    <div class="h-10px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-10px" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 20-->
    </div>
    <div class="col-md-3 col-12">
    <!--begin::Card widget 20-->
        <div class="card card-flush bgi-no-repeat bgi-size-cover bgi-position-x-end mb-5 mb-xl-10 h-175px" style="background-image:url('/assets/img/bg-green.png')">
            <!--begin::Header-->
            <div id="created" class="card-header py-10 fs-2hx fw-bold text-white m-auto px-0">0</div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mb-2">
                        <span class="m-auto">Documents initiés</span>
                    </div>
                    <div class="h-10px mx-3 w-100 bg-white bg-opacity-50 rounded">
                        <div class="bg-white rounded h-10px" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
                <!--end::Progress-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card widget 20-->
    </div>
</div>
<div class="card">
    <div class="card-body py-4">
        <div class="row mb-5">
            <div class="col-md-12 col-12">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Documents consulaires</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Nombre de documents par années</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <div class="row">
                            <div class="col-md-3 offset-md-4 col-12">
                                <label class="fw-bolder text-dark fs-5">Date de début :</label>
                                <input type="text" id="start_date_chart" value="{{ date('Y-m-d') }}" class="form-control date_at" readonly>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="fw-bolder text-dark fs-5">Date de fin :</label>
                                <input type="text" id="end_date_chart" value="{{ date('Y-m-d') }}" class="form-control date_at" readonly>
                            </div>
                            <div class="col-md-2 col-12">
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-success font-weight-bold fs-4 px-6 py-3 submitChart">Rechercher</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget" class="h-500px w-100 min-h-auto ps-4 pe-6"></div>
                    <!--end::Chart-->
                </div>
                <!--end: Card Body-->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Récupérer les stats
            statsData('', $('#start_date_stats').val(), $('#end_date_stats').val());
        });
        document.addEventListener("DOMContentLoaded", async () => {
            initChart();
            let start_date_chart = document.getElementById('start_date_chart').value;
            let end_date_chart = document.getElementById('end_date_chart').value;
            await updateChart(start_date_chart, end_date_chart);
        });
        $(document).on('click', '.submitStats', async function() {
            $(this).addClass('not-active');
            const documents = $('#documents').val();
            const start_date_stats = $('#start_date_stats').val();
            const end_date_stats = $('#end_date_stats').val();
            if (start_date_stats && end_date_stats) {
                await statsData(documents, start_date_stats, end_date_stats);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Veuillez sélectionner une date de début et une date de fin',
                });
                $('.submitStats').removeClass('not-active');
            }
        });

        const statsData = async (documents, start_date_stats, end_date_stats) => {
            try {
                const response = await axios.post('/dashboard', {
                    documents: documents,
                    start_date: start_date_stats,
                    end_date: end_date_stats
                });
                if (response.data.status == 1) {
                    $('#amount').html(response.data.data.amount);
                    $('#paid').html(response.data.data.paid);
                    $('#free').html(response.data.data.free);
                    $('#created').html(response.data.data.created);
                    $('#transmitted').html(response.data.data.transmitted);
                    $('#validated').html(response.data.data.validated);
                    $('#rejected').html(response.data.data.rejected);
                    $('#recovered').html(response.data.data.recovered);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.data.message,
                    });
                }
                $('.submitStats').removeClass('not-active');
            } catch (e) {
                console.error(e);
            }
        }
        $(document).on('click', '.submitChart', async function() {
            $(this).addClass('not-active');
            const start_date_chart = $('#start_date_chart').val();
            const end_date_chart = $('#end_date_chart').val();
            if (start_date_chart && end_date_chart) {
                await updateChart(start_date_chart, end_date_chart);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Veuillez sélectionner une date de début et une date de fin',
                });
            }
            $('.submitChart').removeClass('not-active');
        });
        const listDocs = async (start_date_chart, end_date_chart) => {
            try {
                const response = await axios.post('/listDocs', {
                    start_date: start_date_chart,
                    end_date: end_date_chart
                });
                if (response.data.status == 1) {
                    return {
                        dataDoc: response.data.data.dataDoc,
                        dataNum: response.data.data.dataNum,
                    };
                } else {
                    return {
                        dataDoc: [],
                        dataNum: [],
                    };
                }
            } catch (e) {
                console.error(e);
                return {
                    dataDoc: [],
                    dataNum: [],
                };
            }
        }
        const updateChart = async (start_date_chart, end_date_chart) => {
            const result = await listDocs(start_date_chart, end_date_chart);
            // 🔥 update sans recréer le chart
            chart.updateOptions({
                xaxis: {
                    categories: result.dataDoc
                }
            });
            chart.updateSeries([{
                data: result.dataNum
            }]);
        };
        let chart;
        const initChart = () => {
            var element = document.getElementById("kt_charts_widget");
            var height = 500;
            var labelColor = KTUtil.getCssVariableValue('--bs-danger');
            var options = {
                series: [{
                    name: 'Nombre de documents',
                    data: [] // ✅ OK
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: { show: false }
                },
                grid: {
                    padding: {
                        bottom: 40
                    }
                },
                colors: [
                    KTUtil.getCssVariableValue('--bs-success'),
                    KTUtil.getCssVariableValue('--bs-success-light')
                ],
                plotOptions: {
                    bar: {
                        columnWidth: '25%',
                        borderRadius: 5,
                        dataLabels: {
                            position: "top"
                        }
                    },
                },
                dataLabels: {
                    enabled: true,
                    offsetY: -28,
                    style: {
                        fontSize: '13px',
                        colors: [labelColor]
                    }
                },
                xaxis: {
                    categories: [] // ✅ OK
                }
            };
            chart = new ApexCharts(element, options);
            chart.render();
        };
    </script>
@endsection