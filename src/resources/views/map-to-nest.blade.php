<script>
    var home = {{ $blueiris }};
</script>
<ul class="list-group">
    @foreach($nest->devices->cameras as $camera)
        <li class="list-group-item" data-device-id="{{ $camera->device_id }}"
            data-is-streaming="{{ $camera->is_streaming }}"
            data-is-online="{{ $camera->is_online }}">
                <input type="checkbox">
            {{ $camera->name }}
            @if(!$camera->is_online || !$camera->is_streaming)
                (offline)
            @endif
            @if($camera->is_online && $camera->is_streaming)
                <div style="display:inline-block; max-width: 300px">
                    <img class="img-responsive" src="{{ $camera->snapshot_url }}" alt="{{ $camera->device_id }}">
                </div>
            @endif
        </li>
    @endforeach
</ul>