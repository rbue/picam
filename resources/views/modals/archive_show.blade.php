{{-- Modal - show a recording --}}
<div class="modal fade" id="showRecording" tabindex="-1" role="dialog" aria-labelledby="showRecording" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Schliessen"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="showRecordingLabel">Aufzeichnung ansehen</h4>
            </div>
            <div class="modal-body">
                <embed type="application/x-vlc-plugin" pluginspage="http://www.videolan.org" version="VideoLAN.VLCPlugin.2"  width="100%"  height="100%" id="vlc" loop="yes" autoplay="yes" target=""></embed>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
            </div>
        </div>
    </div>
</div>