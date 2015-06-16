{{-- Modal - show a stream --}}
<div class="modal fade" id="showStream" tabindex="-1" role="dialog" aria-labelledby="showStream" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Schliessen"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="showStreamLabel">Stream anzeigen</h4>
            </div>
            <div class="modal-body">
                <div id="player_wrapper">
                    <embed type="application/x-vlc-plugin" pluginspage="http://www.videolan.org" version="VideoLAN.VLCPlugin.2" id="vlc" loop="yes" autoplay="yes" target="http://10.142.126.116:8554/"></embed>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
            </div>
        </div>
    </div>
</div>