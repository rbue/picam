<div id="player_wrapper">
    @if(env('APP_TESTMODE') == true)
        <embed id="vlc" target="http://link.ac/4Twe10" autoplay="yes" loop="yes" version="VideoLAN.VLCPlugin.2" pluginspage="http://www.videolan.org" type="application/x-vlc-plugin" width="100%" height="680">
    @else
        <embed id="vlc" target="http://10.142.126.116:8554" autoplay="yes" loop="yes" version="VideoLAN.VLCPlugin.2" pluginspage="http://www.videolan.org" type="application/x-vlc-plugin" width="100%" height="680">
    @endif
</div>