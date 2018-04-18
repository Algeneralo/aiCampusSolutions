<div class="panel panel-success col-md-12">
    <div class="panel-heading">
        Submit your information
    </div>
    <input name="college_id" value="{{encrypt($college->id)}}" style="display:none;">
    <div id="studentInfo" class="panel-body">
        <div class="form-group col-md-6">
            <label for="name">Name:</label>
            <input disabled id="name" name="name" type="text" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="email">Email:</label>
            <input disabled id="email" name="email" type="email" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="department">Department:</label>
            <input disabled id="department" name="department" type="text" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="ext">Ext.:</label>
            <input disabled id="ext" name="ext" type="text" class="form-control">
        </div>
        <div class="col-md-12 text-center">
            <input disabled type="submit" class="btn btn-success">
        </div>
    </div>
</div>