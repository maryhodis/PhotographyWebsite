<?php require('./config.php');?>

    <section id="calendar_sec" class="third_block">
        <div class="name_of_block">
            <h2>CALENDAR</h2>
        </div>
        <div class="modal fade" id="addeventmodal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid">

                            <form id="createEvent" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="title-group" class="form-group">
                                            <label class="control-label" for="title">Title</label>
                                            <input type="text" class="form-control" name="title">
                                            <!-- errors will go here -->
                                        </div>

                                        <div id="startdate-group" class="form-group">
                                            <label class="control-label" for="startDate">Start Date</label>
                                            <input type="text" class="form-control datetimepicker" id="startDate" name="startDate">
                                            <!-- errors will go here -->
                                        </div>

                                        <div id="enddate-group" class="form-group">
                                            <label class="control-label" for="endDate">End Date</label>
                                            <input type="text" class="form-control datetimepicker" id="endDate" name="endDate">
                                            <!-- errors will go here -->
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div id="color-group" class="form-group">
                                            <label class="control-label" for="color">Colour</label>
                                            <input type="text" class="form-control colorpicker" name="color" value="#6453e9">
                                            <!-- errors will go here -->
                                        </div>

                                        <div id="textcolor-group" class="form-group">
                                            <label class="control-label" for="textcolor">Text Colour</label>
                                            <input type="text" class="form-control colorpicker" name="text_color" value="#ffffff">
                                            <!-- errors will go here -->
                                        </div>
                                    </div>
                                </div> 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    <div class="modal fade" id="editeventmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="container-fluid">

                        <form id="editEvent" class="form-horizontal">
                        <input type="hidden" id="editEventId" name="editEventId" value="">

                        <div class="row">

                            <div class="col-md-6">

                                <div id="edit-title-group" class="form-group">
                                    <label class="control-label" for="editEventTitle">Title</label>
                                    <input type="text" class="form-control" id="editEventTitle" name="editEventTitle">
                                    <!-- errors will go here -->
                                </div>

                                <div id="edit-startdate-group" class="form-group">
                                    <label class="control-label" for="editStartDate">Start Date</label>
                                    <input type="text" class="form-control datetimepicker" id="editStartDate" name="editStartDate">
                                    <!-- errors will go here -->
                                </div>

                                <div id="edit-enddate-group" class="form-group">
                                    <label class="control-label" for="editEndDate">End Date</label>
                                    <input type="text" class="form-control datetimepicker" id="editEndDate" name="editEndDate">
                                    <!-- errors will go here -->
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div id="edit-color-group" class="form-group">
                                    <label class="control-label" for="editColor">Colour</label>
                                    <input type="text" class="form-control colorpicker" id="editColor" name="editColor" value="#6453e9">
                                    <!-- errors will go here -->
                                </div>

                                <div id="edit-textcolor-group" class="form-group">
                                    <label class="control-label" for="editTextColor">Text Colour</label>
                                    <input type="text" class="form-control colorpicker" id="editTextColor" name="editTextColor" value="#ffffff">
                                    <!-- errors will go here -->
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-danger" id="deleteEvent" data-id>Delete</button>
                </div>

                </form>

            </div>
        </div>
    </div>

    <div class="container">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addeventmodal">Add Event</button>
        <div id="calendar"></div>
    </div>
    </section>