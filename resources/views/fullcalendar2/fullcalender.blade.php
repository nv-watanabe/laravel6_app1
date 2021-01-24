<!DOCTYPE html>
<html>
<head>
    <title>Laravel Fullcalender Add/Update/Delete Event Example Tutorial - Tutsmake.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="{{ asset('vendor/assets/css/codebase.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="{{ asset('vendor/assets/js/codebase.core.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{--    <script src="{{ asset('vendor/assets/js/pages/be_comp_calendar.min.js') }}"></script>--}}

    <style>
        .stock-contents {display: none}
    </style>
</head>
<body>
<span id="result"></span>
<div class="container">
    <div class="response"></div>
{{--    <div id='calendar'></div>--}}

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <!-- Calendar and Events functionality is initialized in js/pages/be_comp_calendar.min.js which was auto compiled from _es6/pages/be_comp_calendar.js -->
            <!-- For more info and examples you can check out https://fullcalendar.io/ -->
            <div class="block">
                <div class="block-content">
                    <div class="row items-push">
                        <div class="col-xl-9">
                            <!-- Calendar Container -->
                            <div class="js-calendar"></div>
                        </div>
                        <div class="col-xl-3 d-none d-xl-block">
                            <!-- Add Event Form -->
                            <form class="js-form-add-event mb-30" action="be_comp_calendar.html" method="post">
                                <div class="input-group">
                                    <input type="text" class="js-add-event form-control" placeholder="Add Event..">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Add Event Form -->

                            <!-- Event List -->
                            <form class="stock-form" method="POST">
                                @csrf
                                <div class="block-content stock-contents">
                                    <div class="form-group">
                                        <div class="form-material">
                                            <input type="hidden" id="stock_id" name="stock_id">
                                            <div class="d-flex justify-content-between">
                                                <div><label for="option_contents">在庫数</label></div>
                                                <button type="button" class="close close-event" style="margin-bottom: 5px">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" id="stock_number" name="stock_number" value="">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div style="margin-right: 20px;">
                                            <span data-toggle="modal" data-target="#deleteModal" data-title="" data-url="">
                                                <button type="button" class="btn btn-secondary event-delete" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <div>
                                            <button type="submit" id="stock_btn" class="btn btn-alt-primary"></button>
                                        </div>
                                    </div>
                                </div>

                            </form>


{{--                            <ul class="js-events list list-events">--}}
{{--                                <li class="bg-info-light">Project Mars</li>--}}
{{--                                <li class="bg-success-light">Cinema</li>--}}
{{--                                <li class="bg-danger-light">Project X</li>--}}
{{--                                <li class="bg-warning-light">Skype Meeting</li>--}}
{{--                                <li class="bg-info-light">Codename PX</li>--}}
{{--                                <li class="bg-success-light">Weekend Adventure</li>--}}
{{--                                <li class="bg-warning-light">Meeting</li>--}}
{{--                                <li class="bg-success-light">Walk the dog</li>--}}
{{--                                <li class="bg-info-light">AI schedule</li>--}}
{{--                            </ul>--}}
{{--                            <div class="text-center">--}}
{{--                                <em class="font-size-xs text-muted"><i class="fa fa-arrows"></i> Drag and drop events on the calendar</em>--}}
{{--                            </div>--}}
                            <!-- END Event List -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Calendar -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
{{--    <footer id="page-footer" class="opacity-0">--}}
{{--        <div class="content py-20 font-size-sm clearfix">--}}
{{--            <div class="float-right">--}}
{{--                Crafted with <i class="fa fa-heart text-pulse"></i> by <a class="font-w600" href="https://1.envato.market/ydb" target="_blank">pixelcave</a>--}}
{{--            </div>--}}
{{--            <div class="float-left">--}}
{{--                <a class="font-w600" href="https://1.envato.market/95j" target="_blank">Codebase 3.4</a> &copy; <span class="js-year-copy"></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}
    <!-- END Footer -->
</div>
</body>

{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        $(function(){--}}
{{--            // $(window).on('load', function(){--}}
{{--                $(".fc-content:contains('在庫')").each(function(){--}}
{{--                    var a = $(this).text();--}}
{{--                    $(this).closest('.fc-event-container').addClass('stock-event')--}}
{{--                    console.log(a);--}}
{{--                });--}}
{{--            // });--}}
{{--        });--}}
{{--    })--}}

{{--</script>--}}
@include('fullcalendar2.list')

</html>
