<div>
    <h2>{{$logTitle}}</h2>
    <div class ="log-filter">
        <div class="log-filter-group">
            <?php $i=0 ?>
            @foreach ($logTypes as $logType)
            <p class="log-filter">
                @if (in_array($logType->ID, $filters))
                <input type="checkbox" name="filter-{{$logType->ID}}" value="{{$logType->ID}}" class="log-filter" id="FILTER-{{$logType->ID}}" checked>
                @else
                <input type="checkbox" name="filter-{{$logType->ID}}" value="{{$logType->ID}}" class="log-filter" id="FILTER-{{$logType->ID}}">
                @endif
                <label for="FILTER-{{$logType->ID}}">{{$logType->Name}}</label>
            </p>
            @if ( $i++ >= 4)
            <br/>
            <?php $i=0 ?>
            @endif
            @endforeach
        </div>
        <div class="filter-btn-box">
        <button id="log-filter-refresh" class="log-filter-refresh-btn small-buttons">Refresh</button><br/>
        <button id="log-filter-select-all" class="log-filter-refresh-btn small-buttons">Select All</button><br/>
        <button id="log-filter-select-none" class="log-filter-refresh-btn small-buttons">Select None</button><br/>
        </div>
    </div>
    <table cellpadding="0" class="log-table">
        <tr class="log-table-row">
            <th class="log-table-date"> Timestamp</th>
            <th class="log-table-user"> Username</th>
            <th class="log-table-type"> Type</th>
            <th class="log-table-message"> Message</th>

        </tr>
    @foreach ($logs as $log)
        <tr class="log-table-row">
            <td class="log-table-date">{{$log->LogDate}}</td>
            <td class="log-table-user">{{$log->user->username}}</td>
            <td class="log-table-type">{{$log->type->Name}}</td>
            <td class="log-table-message">{{$log->LogMessage}}</td>
        </tr>
    @endforeach
    </table>
</div>
