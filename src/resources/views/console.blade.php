<div id="blueiris">
    <div id="blueirisHeader">
        <h1>BlueIris Console</h1>
        <div id="system"></div>
        <div id="status" data-role="status" data-status="?" class="display-debug">
            <div id="home"></div>
            <div id="away"></div>
        </div>
    </div>
    <div id="screens">
        <div id="overview" data-role="overview">
            <div id="actions">
                <div class="btn btn-default" data-trigger-event-type="view:clips">View Clips</div>
            </div>
            <div id="cameras" data-role="cameras" style="display: flex; flex-flow: wrap"></div>
        </div>
        <div id="camera" data-role="camera">
            <div id="camera-title" data-role="camera.title" data-camera-id="?">
                <a id="camera-close" href="#close" class="display-debug">Back/Close</a>
                <h1 class="camera-title-text" data-role="camera.title.text"></h1>
                <a id="camera-settings" href="#settings" class="display-debug">Camera settings</a>
            </div>
            <div id="when" data-role="camera.datetime" class="display-debug">
                <div id="timestamp" data-role="camera.timestamp">2:30:00 PM</div>
                <div id="date" data-role="camera.date">Today</div>
            </div>
        </div>
        <div id="clips" data-role="clips">
            <!-- sort by date, group by camera -->
        </div>
        <div id="alerts" data-role="alerts"></div>
        <div id="logs" data-role="logs" class="display-debug"></div>
    </div>
</div>

@section('scripts.footer')
    <script>
        window.blueiris = {!! $data !!};
    </script>
@stop

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/components/blueiris-console.css">
@stop