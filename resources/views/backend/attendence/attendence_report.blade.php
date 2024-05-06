@extends('backend.master')

@push('css')
    <style>
        .employee_details p{
            margin: 1px;
        }
    </style>
@endpush

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Attendence Report</h4>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30" id="printDiv">
                        <div class="card-body">
                            <div class="employee_details text-center mb-5">
                                <h5>{{ $employee->name }}</h5>
                                <p>{{ $employee->designation }}</p>
                                <p>Phone: {{ $employee->phone }}</p>
                                <p>Month: {{ \Carbon\Carbon::create()->month($month)->format('F'); }}, {{ $year }}</p>
                            </div>

                            <table class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">#SL</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Day</th>
                                        <th class="text-center">In Time</th>
                                        <th class="text-center">Out Time</th>
                                        <th class="text-center">Total Working Hours</th>
                                        <th class="text-center">Late Time</th>
                                        <th class="text-center">Over Time</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($days as $day)
                                    @php
                                        $nullIntime = $day['inTime'] == null;
                                        $nullOutTime = $day['outTime'] == null;
                                        $totalOfficeTime = '08:00:00';
                                        $previousDayFromToday = $day['date'] <= date('Y-m-d');

                                        $carbonDate = \Carbon\Carbon::parse($day['date']);
                                        $dayName = $carbonDate->format('l');
                                    @endphp
                                        <tr>
                                            <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $day['date'] }}</td>
                                            <td class="text-center">
                                                <span class="{{ $dayName == "Friday" ? 'badge badge-danger' : '' }}">{{ $dayName }}</span>

                                            </td>
                                            <td class="text-center">
                                                @if ($previousDayFromToday && $nullIntime)
                                                    <span class="badge badge-danger">Leave</span>
                                                @elseif ($day['inTime'] != null)
                                                    <span>{{ date('h:i A', strtotime($day['inTime'])) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($previousDayFromToday && $nullOutTime)
                                                    <span class="badge badge-danger">Leave</span>
                                                @elseif ($day['outTime'] != null)
                                                    <span>{{ date('h:i A', strtotime($day['outTime'])) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($previousDayFromToday && $nullIntime && $nullOutTime)
                                                    <span class="badge badge-danger">Leave</span>
                                                @elseif ($day['workingHour'] != "0")
                                                    <span class="{{ strtotime($day['workingHour']) < strtotime($totalOfficeTime) ? 'bg-danger p-1' : '' }}">{{ $day['workingHour'] }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($previousDayFromToday && $nullIntime && $nullOutTime)
                                                    <span class="badge badge-danger">Leave</span>
                                                @elseif ($previousDayFromToday && $day['late'] == "0")
                                                    <span>N/A</span>
                                                @elseif ($day['late'] != "0")
                                                    <span class="bg-warning p-1">{{ $day['late'] }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($previousDayFromToday && $nullIntime && $nullOutTime)
                                                    <span class="badge badge-danger">Leave</span>
                                                @elseif ($previousDayFromToday && $day['overtime'] == "0")
                                                    <span>N/A</span>
                                                @elseif ($day['overtime'] != "0")
                                                    <span class="bg-success p-1">{{ $day['overtime'] }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5"><strong>Total Count:</strong></td>
                                        <td><strong>{{ $totalWorkingHours }} Hours</strong></td>
                                        <td><strong>{{ $totalLateHours }} Hours</strong></td>
                                        <td><strong>{{ $totalOvertimeHours }} Hours</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-info" id="printBtn">Print Result</button>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
@endsection

@push('js')
    <script>
        $('#printBtn').on('click', function() {
            var divToPrint = $('#printDiv');
            printDiv(divToPrint);
        });

        function printDiv(divElement) {
            var printContents = divElement.html();

            var originalContents = $('body').html();

            $('body').html(printContents);
            window.print();

            $('body').html(originalContents);
        }
    </script>
@endpush
