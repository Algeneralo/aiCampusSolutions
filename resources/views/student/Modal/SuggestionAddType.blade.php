<!-- Modal -->
<div id="add_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Suggest new data</h4>
            </div>
            <form id="add_modal_form" action="\Suggestion" method="post">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                New data info
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-md-6">
                                    <label for="subject">Subject:</label>
                                    <textarea name="subject" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="info">Info:</label>
                                    <textarea name="info" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="link1">link1:</label>
                                    <textarea name="link1" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="link2">link2:</label>
                                    <textarea name="link2" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        @include('student.studentInfoForm')
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