<div id="home">
    <div id="homeHeader">
        <h1>Home Console</h1>
        @if($eight || $nest)
            <div class="row">
                @if($nest)
                    <div class="col-xs-6">
                        <div class="row">
                            <div class="col-xs-2">
                                <img class="img-responsive" src="//cdn.joejiko.com/img/vendor/nest/nest_logo.png">
                            </div>
                            <div class="col-xs-10">
                                @foreach($nest->structures as $id => $structure)
                                    {{ $structure->name }}
                                    Status: <button class="btn">{{ $structure->away }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                @if($eight)
                    <div class="col-xs-6">
                        <div class="row">
                            <div class="col-xs-2">
                                <img class="img-responsive" src="//cdn.joejiko.com/img/vendor/eight/EightLogo.png">
                            </div>
                            <div class="col-xs-10">
                                @foreach($eight as $device)
                                    Left side heating:
                                    <button class="btn">{{ $device->leftNowHeating ? "on" : "off" }}</button>
                                    Right side heating:
                                    <button class="btn">{{ $device->rightNowHeating ? "on": "off" }}</button><br>
                                    Status: {{ $device->online ? "online" : "offline" }} Last
                                    Heard: {{ $device->lastHeard }}
                                    LED: {{ $device->ledBrightnessLevel }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        <div id="system"></div>
        <div id="status" data-role="status" data-status="?" class="display-debug">
            <div id="home"></div>
            <div id="away"></div>
        </div>
        <div id="controls" data-role="controls">
            <button class="btn btn-warning">Restart all cameras</button>
            <a class="btn btn-primary" href="/admin/home/map-to-nest">Map Nest cameras</a>
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

@push('scripts.footer')
    <script>
        window.home = {!! $data !!};
    </script>
@endpush

@section('styles')
    @parent
    <link rel="stylesheet" href="/css/components/home-console.css">
@stop