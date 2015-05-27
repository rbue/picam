{{-- Modal - Add a stream --}}
<div class="modal fade" id="addStream" tabindex="-1" role="dialog" aria-labelledby="addStream" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Schliessen"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addStreamLabel">Stream hinzufügen</h4>
            </div>
            <div class="modal-body">
                <form id="frm_addStream">
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titel/Bezeichnung">
                    </div>
                    <div class="form-group">
                        <label for="ip">IP-Adresse</label>
                        <input type="text" class="form-control" id="ip" name="ip" placeholder="IP-Adresse">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="button" class="btn btn-primary" id="btn_addStream">Speichern</button>
            </div>
        </div>
    </div>
</div>