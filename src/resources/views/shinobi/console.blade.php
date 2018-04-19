@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.7.1/video-js.min.css"/>
@endpush
@push('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.7.1/video.js"
            integrity="sha256-GDmu5FrG9plSLDhicl1P5U+D922op2Uf+aq4ItRS7VM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.12.2/videojs-contrib-hls.js"
            integrity="sha256-+WQ6vDOu4x90JD/kiamKJS+j25CKfgBxj9sePEuy6og=" crossorigin="anonymous"></script>
    <script>
        let w = setInterval(jqueryReady, 100);
        let v, vgroupslist, smonitor;
        let home = {};

        function renderPlayers(data) {
            let $content = $("#content .container");

            $.each(data.vgroups, function (j, group) {
                let $group = $(`<div class="row" />`);
                $group.append(`<strong>${vgroupslist[j].name}</strong><br>`);
                $group.appendTo($content);

                // if group.length?
                $.each(group, function (i, mid) {
                    let monitor = data.vsorted[mid];
                    let $col = $('<div class="col-xs-4" />');
                    let service = "nest";
                    let $video;
                    if (monitor.host.indexOf("dropcam") > -1) {
                        $video = $(`
                                <video id="${service}-${j}-${i}" width="${monitor.width}" height="${monitor.height}" class="video-js vjs-default-skin" controls data-setup='{"fluid":true}'>
                                    <source src="https://${monitor.host}:443/nexus_aac/${monitor.mid}/playlist.m3u8" type="application/x-mpegURL">
                                </video>
                            `);
                    }

                    if (monitor.type === "h264") {
                        $video = $(`
                                <video id="${service}-${j}-${i}" width="${monitor.width}" height="${monitor.height}" class="video-js vjs-default-skin" controls data-setup='{"fluid":true}'>
                                    <source src="https://${home.api_host}/${home.api_key}/hls/${home.user_group}/${mid}/s.m3u8" type="application/x-mpegURL">
                                </video>
                            `);
                    }

                    $col.append(`<strong>${monitor.name}</strong><br>`, $video);
                    $col.appendTo($group);
                    let player = videojs(`#${service}-${j}-${i}`);
                    player.play();
                });
            });
        }

        function varsReady() {
            if (typeof(vgroupslist) !== "undefined" && typeof(smonitor) !== "undefined") {
                clearInterval(v);

                let vgroups = {};
                let vsorted = {};
                // sort videos by groups
                $.each(smonitor, function (i, vid) {
                    let groups = JSON.parse(vid.details).groups;
                    if (typeof(groups) === "string") {
                        groups = JSON.parse(groups);
                    }
                    if (typeof(groups) === "object") {
                        $.each(groups, function (j, gid) {
                            if (!vgroups.hasOwnProperty(gid)) {
                                vgroups[gid] = [];
                            }

                            vgroups[gid].push(vid.mid);
                        });
                    }
                });

                // resort videos by mid
                $.each(smonitor, function (i, vid) {
                    vsorted[vid.mid] = vid;
                });

                renderPlayers({vsorted, vgroups});
            }
        }

        function jqueryReady() {
            "use strict";
            if (typeof($) === "function") {
                clearInterval(w);

                home.api_host = "192.168.87.190";
                home.api_key = "Y734eRzqTAdgZydo0P2UOViE5ZCZ74J8";
                home.user_group = "uLzoBTU";

                $.get(`https://${home.api_host}/${home.api_key}/userInfo/${home.user_group}`, function (resp) {
                    if (resp.ok) {
                        vgroupslist = JSON.parse(resp.user.details.mon_groups);
                    }
                });
                $.get(`https://${home.api_host}/${home.api_key}/smonitor/${home.user_group}`, function (resp) {
                    smonitor = resp;
                });

                v = setInterval(varsReady, 100);
            }
        }
    </script>
@endpush