@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body py-4">
        <div class="row mb-5">
            <div class="col-md-3 col-12">
                <label class="fw-bolder text-dark fs-5">Documents : <span class="text-danger">*</span></label>
                <select id="documents" class="form-select">
                    <option value="" selected>Tous les documents</option>
                    @foreach($documents as $data)
                        <option value="{{ $data->document_id }}">{{ optional($data->document)->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-12">
                <label class="fw-bolder text-dark fs-5">Années : <span class="text-danger">*</span></label>
                <select id="years" class="form-select">
                    <option value="" selected>Toutes les années</option>
                    @foreach($years as $data)
                        <option value="{{ $data->years }}">{{ $data->years }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-12">
                <label class="fw-bolder text-dark fs-5">Mois : <span class="text-danger">*</span></label>
                <select id="months" class="form-select">
                    <option value="" selected>Tous les mois</option>
                </select>
            </div>
            <div class="col-md-3 col-12">
                <label class="fw-bolder text-dark fs-5">Jours : <span class="text-danger">*</span></label>
                <select id="days" class="form-select">
                    <option value="" selected>Tous les jours</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row mb-5 mt-10">
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
                        <span class="m-auto">Tous les paiements</span>
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
            <div id="number" class="card-header py-10 fs-2hx fw-bold text-white m-auto px-0">0</div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex align-items-end pt-0" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                <!--begin::Progress-->
                <div class="d-flex align-items-center flex-column mt-3 w-100">
                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mb-2">
                        <span class="m-auto">Toutes les demandes</span>
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
                        <span class="m-auto">Demandes payées</span>
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
                        <span class="m-auto">Demandes gratuites</span>
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
                        <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                        <select id="docyears" class="form-select">
                            <option value="" disabled>Toutes les années</option>
                            @foreach($years as $data)
                                <option value="{{ $data->years }}">{{ $data->years }}</option>
                            @endforeach
                        </select>
                        <!--end::Daterangepicker-->
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
  	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            // Récupérer les stats
            statsData('', '', '', '');
        });
        document.addEventListener("DOMContentLoaded", async () => {
            initChart();
            let docyears = document.getElementById('docyears').value;
            await updateChart(docyears);
        });
        $(document).on('change', '#documents, #years, #months, #days', function() {
            if ($('#years').val() == '') {
                $('#months').html('<option value="" selected>Tous les mois</option>');
                $('#days').html('<option value="" selected>Tous les jours</option>');
            }
            if ($('#months').val() == '') {
                $('#days').html('<option value="" selected>Tous les jours</option>');
            }
            const documents = $('#documents').val();
            const years = $('#years').val();
            const months = $('#months').val();
            const days = $('#days').val();
            if (years && !months) {
                const listMonths = async (documents, years) => {
                    try {
                        const response = await axios.post('/listMonths', {
                            documents: documents,
                            years: years
                        });
                        const months = response.data.data;
                        const monthFr = [
                            "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
                        ];
                        $('#months').html('<option value="" selected>Tous les mois</option>');
                        for (let i = 0; i < months.length; i++) {
                            $('#months').append('<option value="' + months[i].months + '">' + monthFr[months[i].months - 1] + '</option>');
                        }
                    } catch (e) {
                        console.error(e);
                    }
                }
                listMonths(documents, years);
            }
            if (years && months && !days) {
                const listDays = async (documents, years, months) => {
                    try {
                        const response = await axios.post('/listDays', {
                            documents: documents,
                            years: years,
                            months: months
                        });
                        const days = response.data.data;
                        $('#days').html('<option value="" selected>Tous les jours</option>');
                        for (let i = 0; i < days.length; i++) {
                            $('#days').append('<option value="' + days[i].days + '">' + days[i].days + '</option>');
                        }
                    } catch (e) {
                        console.error(e);
                    }
                }
                listDays(documents, years, months);
            }
            statsData(documents, years, months, days);
        });
        const statsData = async (documents, years, months, days) => {
            try {
                const response = await axios.post('/dashboard', {
                    documents: documents,
                    years: years,
                    months: months,
                    days: days
                });
                if (response.data.status == 1) {
                    $('#amount').html(response.data.data.amount);
                    $('#number').html(response.data.data.number);
                    $('#paid').html(response.data.data.paid);
                    $('#free').html(response.data.data.free);
                }
            } catch (e) {
                console.error(e);
            }
        }
        $(document).on('change', '#docyears', async function() {
            let docyears = $(this).val();
            await updateChart(docyears);
        });
        const listDocs = async (docyears) => {
            try {
                const response = await axios.post('/listDocs', {
                    docyears: docyears
                });
                console.log(response.data);
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
        const updateChart = async (year) => {
            const result = await listDocs(year);
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