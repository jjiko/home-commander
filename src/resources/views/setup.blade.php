<h1>BlueIris Setup</h1>
<form data-role="auth.blueiris.form" action="/auth/connection/handler/blueiris" method="post">
    <input type="hidden" name="session">
    <input type="hidden" name="system">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="LAN">Local IP</label>
                    <input data-role="auth.blueiris.endpoint" list="localAddresses" name="lan" id="LAN" class="form-control">
                    <datalist id="localAddresses">
                        <option value="Loading your local IPs&hellip;"></option>
                    </datalist>
                </div>
                <div class="form-group col-md-4">
                    <label for="lan_port">Port</label>
                    <input data-role="auth.blueiris.port" id="lan_port" name="lan_port" class="form-control" type="text" value="81">
                </div>
            </div>
            {{--<div class="checkbox"><label for="manualEntry"><input name="manualEntry" type="checkbox">Not this PC</label></div>--}}

            <div class="row">
                <div class="form-group col-md-8">
                    <label for="WAN">Internet IP</label>
                    <input id="WAN" name="wan" class="form-control" type="text" readonly
                           value="<?php echo \Input::server('REMOTE_ADDR'); ?>">

                </div>
                <div class="form-group col-md-4">
                    <label for="wan_port">Port</label>
                    <input id="wan_port" name="wan_port" class="form-control" type="text" value="81">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="BlueIrisUsername">Username</label>
                    <input autocomplete="off" data-role="auth.blueiris.username" id="BlueIrisUsername" name="username" class="form-control" type="text">
                </div>
                <div class="form-group col-md-12">
                    <label for="BlueIrisPassword">Password</label>
                    <input autocomplete="off" data-role="auth.blueiris.password" id="BlueIrisPassword" name="password" class="form-control" type="password">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-default" data-role="auth.blueiris.setup">Login</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    'use strict';

    let lanSelect = document.querySelector('#localAddresses');
    let addrs = {"0.0.0.0": false};
    let rtc = new RTCPeerConnection({iceServers: []});
    rtc.createDataChannel('', {reliable: false});

    rtc.onicecandidate = function (evt) {
        // convert the candidate to SDP so we can run it through our general parser
        // see https://twitter.com/lancestout/status/525796175425720320 for details
        if (evt.candidate) grepSDP("a=" + evt.candidate.candidate);
    };
    rtc.createOffer().then(function (offerDesc) {
        grepSDP(offerDesc.sdp);
        rtc.setLocalDescription(offerDesc);
    }).catch(function (e) {
        console.warn("offer failed", e);
    });

    function updateDisplay(newAddr) {
        if (newAddr in addrs) return;
        addrs[newAddr] = (!!newAddr.match(/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/));

        let hosts = Object.keys(addrs).filter(function (k) {
            return addrs[k];
        });

        // cleanup
        while (lanSelect.firstChild) lanSelect.removeChild(lanSelect.firstChild);
        lanSelect.disabled = false;

        for (let value of hosts) {
            let option = document.createElement('option');
            option.append(value);
            lanSelect.append(option);
        }
    }

    function grepSDP(sdp) {
        sdp.split('\r\n').forEach(function (line) { // c.f. http://tools.ietf.org/html/rfc4566#page-39
            if (~line.indexOf("a=candidate")) {     // http://tools.ietf.org/html/rfc4566#section-5.13
                let parts = line.split(' '),        // http://tools.ietf.org/html/rfc5245#section-15.1
                    addr = parts[4],
                    type = parts[7];
                if (type === 'host') updateDisplay(addr);
            } else if (~line.indexOf("c=")) {       // http://tools.ietf.org/html/rfc4566#section-5.7
                let parts = line.split(' '),
                    addr = parts[2];
                updateDisplay(addr);
            }
        });
    }
</script>