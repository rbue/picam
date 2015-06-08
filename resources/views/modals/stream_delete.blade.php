{{-- Modal - Delete confirmation --}}
<div class="modal fade" id="deleteStream" tabindex="-1" role="dialog" aria-labelledby="deleteStream" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Schliessen"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteStreamLabel">Stream löschen</h4>
            </div>
            <div class="modal-body">
                <p>Sind Sie sicher, dass Sie diesen Stream löschen wollen?</p>
                <form id="frm_deleteStream">
                    <input type="hidden" name="deleteId" id="deleteId" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="button" class="btn btn-danger" id="btn_deleteStream">Löschen</button>
            </div>
        </div>
    </div>
</div>