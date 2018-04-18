<!-- Modal -->
<div id="edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit question Category</h4>
            </div>
            <form id="edit_modal_form">
                <div class="modal-body">
                    <div class="row">
                        <input id="edit_modal_id" type="hidden">
                        <div class="form-group col-md-8">
                            <label for="edit_modal_question">Question</label>
                            <input id="edit_modal_question" name="edit_modal_question" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="edit_modal_college">College</label>
                            <select id="edit_modal_college" name="edit_modal_college" class="form-control">
                                @foreach($colleges as $college)
                                    <option value="{{$college->id+26497}}">{{$college->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn green">
                </div>
            </form>
        </div>

    </div>
</div>