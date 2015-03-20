<table class="kit-details-dialog">
    <tr>
        <td style="vertical-align: top;">
            <table class="kit-details-details">
                <tr><th colspan="2">Kit</th></tr>
                <tr>
                    <td>Type-Name:</td>
                    <td>{{$kit->type->Name}} - {{$kit->Name}}
                        @if ($kit->specialized == "1")
                            + {{$kit->SpecializedName}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Barcode:</td>
                    <td>{{$kit->BarcodeNumber}}</td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>{{$kit->KitDesc}}</td>
                </tr>
                <tr>
                    <td>At Branch:</td>
                    <td>{{$kit->atBranch->BranchID}} - {{$kit->atBranch->PhoneNumber}}</td>
                </tr>
                <tr>
                    <td>State:</td>
                    <td>{{$kit->state->StateName}} @if ($kit->Available == false) <font class="text-red"> - UNAVAILABLE FOR BOOKING</font> @endif
                    </td>
                </tr>
            </table>
            @if(count($logs) != 0)
                <table class="kit-details-logs">
                    <tr>
                        <th colspan="2">Damage/ missing</th>
                        <th>Item</th>
                        <th>Message</th>
                    </tr>
                    @foreach($logs as $log)
                        <tr class="
                        @if($log->LogType == '1')
                        contents-damaged
                        @else
                        contents-missing
                        @endif
                        ">
                        @if($log->LogType == '1')
                        <td style="width:10%;">Damaged</td>
                        @else
                        <td style="width:10%;">Missing</td>
                        @endif
                            <td style="width:20%;">{{date("D M-d-Y",strtotime($log->LogDate))}}</td>
                            <td>{{$log->Name}}({{$log->SerialNumber}})</td>
                            <td>{{$log->LogMessage}}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
             @if(count($bookings) != 0)
                <table class="kit-details-bookings">
                    <tr><th>Bookings</th><th>From</th><th>To</th><th>Users</th></tr>
                    @foreach($bookings as $book)
                    <tr class="kit-booking @if(strtotime($book->EndDate) > getdate()[0] ) after @else before @endif">
                        <td>{{$book->branch->BranchID}}</td>
                        <td>{{date("D M-d-Y",strtotime($book->StartDate))}}</td>
                        <td>{{date("D M-d-Y",strtotime($book->EndDate))}}</td>
                        <td>
                            <ul>
                            @foreach($book->details as $detail)
                                @if(isset($detail->UserID) && $detail->UserID != null)
                                    <li type="none" class="@if($detail->Booker == '1')booker @endif">{{$detail->user->realname}}({{$detail->user->email}})</li>
                                @else
                                    <li type="none">{{$detail->Email}}</li>
                                @endif
                            @endforeach
                        </ul>
                        </td>
                    </tr>
                    @endforeach
                </table>
            @endif
    </tr>
</table>
