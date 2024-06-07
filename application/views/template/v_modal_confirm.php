
    <div id="modal_confirm_global" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                </div>
                <div class="modal-body">
                    <p>Message Here !!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="modal_confirm_act()">Tidak</button>
                    <a href="<?php echo base_url().'akses/user_group_delete?user_group_id='.$p->user_group_id ?>" class="btn btn-primary">Ya</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function modal_confirm(message, title = null){
            $('#modal_confirm_global').modal('show');
            $('#modal_confirm_global').find('.modal-body').children().first().html(message);

            if(title!==null){
                $('#modal_confirm_global').find('.modal-title').html(title);
            }
        }

        function modal_confirm_act(action){

        }
    </script>