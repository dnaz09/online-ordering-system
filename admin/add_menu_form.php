<div class="modal fade" id="createPost" tab-index="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Create Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-sm-12 input-group mb-3">
                            <input type="text" class="form-control" readonly="true">
                            <div class="input-group-append">
                                <label class="input-group-btn">
                                <span class="btn btn-dark">
                                    <i class="fa fa-folder-open"></i>
                                    Browse&hellip; <input type="file" name="file" id="file" style="display: none;" required="true">
                                </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-heading"></i></span>
                            </div>
                            <input type="text" name="title" id="id_title" required="true" pattern='\S(.*\S)?' class="form-control" placeholder="Title">
                        </div>
                        <div class="col-sm-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                            </div>
                            <input type="text" name="content" id="id_content" required="true" pattern='\S(.*\S)?' class="form-control"  placeholder="Description">
                        </div>
                        <div class="col-sm-12 input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" name="price" id="id_price" class="form-control" placeholder="Price" required="true">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="save_post" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-redo"></i> Clear Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var input = document.getElementById('id_title');
    input.onkeypress = function(evt) {
        evt = evt || window.event;
        var charCode = evt.which || evt.keyCode;
        var charStr = String.fromCharCode(charCode);
        if (/[A-Za-z0-9\s]/.test(charStr)) {
            return true;
        }
        else{
        return false;
        }
    };
</script>

<script>
    var input = document.getElementById('id_content');
    input.onkeypress = function(evt) {
        evt = evt || window.event;
        var charCode = evt.which || evt.keyCode;
        var charStr = String.fromCharCode(charCode);
        if (/[A-Za-z0-9\s]/.test(charStr)) {
            return true;
        }
        else{
        return false;
        }
    };
</script>