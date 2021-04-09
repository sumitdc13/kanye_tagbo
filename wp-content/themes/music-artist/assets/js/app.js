(function($) {




$(".iframe-link").YouTubePopUp();

if (!$('#music_player').hasClass('nomargin')) {
  $(".site-info").addClass("removemargin");
}


    function responsiveIframe() {
        var videoSelectors = [
            'iframe[src*="player.vimeo.com"]',
            'iframe[src*="youtube.com"]',
            'iframe[src*="youtube-nocookie.com"]',
            'iframe[src*="kickstarter.com"][src*="video.html"]',
            'iframe[src*="screenr.com"]',
            'iframe[src*="blip.tv"]',
            'iframe[src*="dailymotion.com"]',
            'iframe[src*="viddler.com"]',
            'iframe[src*="qik.com"]',
            'iframe[src*="revision3.com"]',
            'iframe[src*="hulu.com"]',
            'iframe[src*="funnyordie.com"]',
            'iframe[src*="flickr.com"]',
            'embed[src*="v.wordpress.com"]',
            'iframe[src*="videopress.com"]',
            'embed[src*="videopress.com"]'
            // add more selectors here
        ];
        var allVideos = videoSelectors.join(',');
        jQuery(allVideos).wrap('<span class="media-holder" />');
    }

    // Responsive Iframes
    responsiveIframe();


if( $('#msplayer').length ){
        var svg_pp = new SVGMorpheus('#ms_play_pause');
        var svg_vol = new SVGMorpheus('#ec_volume');

        $('#msplayer').mediaelementplayer({
            features: ['current','progress','duration','tracks'],
            success: function(media, node, player) {
                var events = ['loadstart', 'play','pause', 'ended'];
                var playlist = {playing:0, list:[]};

                $('#music_player .pl-list').find('.tr-item').each(function(){
                    var _row = $(this);
                    var _rid = _row.data('id');
                    var _audio = _row.find('.pl-audio-item').data('url');
                    var _thumb = _row.find('.pl-audio-item').data('thumb');
                    var _title = _row.find('.pl-audio-item').find('.pl-item-title').text();
                    var _artist = _row.find('.pl-audio-item').find('.pl-item-artist').text();

                    playlist.list.push({ id:_rid, audio:_audio, thumb:_thumb, title:_title, artist:_artist});
                });


                // load song
                var load_song = function(load_index){
                    if( playlist.list.length>0 && playlist.list.length>load_index && load_index>-1 ){
                        var _current_media = playlist.list[load_index];
                        playlist.playing = load_index;
                        media.setSrc(_current_media.audio);
                        media.load();

                        $('#music_player .ms-nowplaying').find('.np-thumb').attr('src', _current_media.thumb);
                        $('#music_player .ms-nowplaying').find('.np-title').text(_current_media.title);
                        $('#music_player .ms-nowplaying').find('.np-artist').text(_current_media.artist);
                        $('#music_player .pl-list').find('.tr-item .td-num .number.playing').removeClass('playing');
                        $('#music_player .pl-list').find('.tr-item').eq(load_index).find('.td-num .number').addClass('playing');
                    }
                }

                // play song
                var play_song = function(){
                    media.play();
                }

                // play previous previous
                var play_prev = function(){
                    if( playlist.playing == 0 && playlist.list.length>0 ){
                        playlist.playing = playlist.list.length-1;
                    }
                    else{
                        playlist.playing = playlist.playing - 1;
                    }
                    load_song(playlist.playing);
                    play_song();
                }

                // play next song
                var play_next = function(){
                    if( playlist.list.length>0 && playlist.playing == playlist.list.length-1 ){
                        playlist.playing = 0;
                    }
                    else{
                        playlist.playing = playlist.playing + 1;
                    }

                    if( $('#music_player .ms-control-shuffle').hasClass('active') ){
                        playlist.playing = Math.floor(Math.random() * playlist.list.length-1);
                    }

                    load_song(playlist.playing);
                    play_song();
                }

                // set first audio file
                if( playlist.list.length ){
                    load_song(0);
                }

                // player events
                for (var i=0, il=events.length; i<il; i++) {
                    var eventName = events[i];
                    media.addEventListener(events[i], function(e) {
                        if( e.type=='play' ){
                            $('#music_player .ms-play').addClass('ms-pause');
                            svg_pp.to('ms_pause', {duration:400, rotation:'none'});
                        }
                        else if( e.type=='pause' ){
                            $('#music_player .ms-play').removeClass('ms-pause');
                            svg_pp.to('ms_play', {duration:400, rotation:'none'});
                        }
                        else if( e.type=='loadstart' ){

                        }
                        else if( e.type=='ended' ){
                            var _current_number = playlist.playing;

                            if( playlist.playing==playlist.list.length-1 ){
                                if( $('#music_player .ms-control-repeat').hasClass('active') ){
                                    _current_number = 0;
                                }
                                else{
                                    _current_number = -1;
                                }
                            }
                            else{
                                if( $('#music_player .ms-control-shuffle').hasClass('active') ){
                                    _current_number = Math.floor(Math.random() * playlist.list.length-1);
                                }
                                else{
                                    _current_number += 1;
                                }

                            }

                            console.log('ended', _current_number);

                            if( _current_number>-1 ){
                                load_song(_current_number);
                                play_song();
                            }
                        }
                    });
                }

                // play action
                $('#music_player .ms-play').on('click', function(){
                    if (media.paused){
                        media.play();
                    }
                    else{
                        media.pause();
                    }
                });

                // previous action
                $('#music_player .ms-prev').on('click', function(){
                    play_prev();
                });

                // next action
                $('#music_player .ms-next').on('click', function(){
                    play_next();
                });

                // Volume
                $('#music_player .ec-vol-el').slider({
                    orientation: "vertical",
                    range: "min",
                    min: 0,
                    max: 100,
                    value: 80,
                    slide: function( event, ui ) {
                        media.setVolume(ui.value/100);
                    }
                });

                $('#music_player .ms-controls .ec-volume a').on('click', function(){
                    $(this).toggleClass('ec-vol-mute');
                    if( $(this).hasClass('ec-vol-mute') ){
                        media.setVolume(0);
                        svg_vol.to('vol_mute', {duration:400, rotation:'none'});
                        $('#music_player .ec-vol-el').slider('value', 0);
                    }
                    else{
                        media.setVolume(0.8);
                        svg_vol.to('vol_max', {duration:400, rotation:'none'});
                        $('#music_player .ec-vol-el').slider('value', 80);
                    }
                });

                // shuffle
                $('#music_player .ms-control-shuffle').on('click', function(){
                    $('.ms-control-shuffle').toggleClass('active');
                });

                // repeat
                $('#music_player .ms-control-repeat').on('click', function(){
                    $(this).toggleClass('active');
                });

                // playlist
                $('#music_player .pl-list .tr-item .pl-audio-item').on('click', function(){
                    var _index = $('#music_player .pl-list .tr-item').index( $(this).parents('.tr-item') );
                    load_song(_index);
                    play_song();
                });

            }
        });
    }
    
})(jQuery);

