<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{   __('Edit Course Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="ajaxEditForm" class="modal-form"
                    action="{{ route('user.course_management.update_category') }}" method="post">

                    @csrf
                    @method('PUT')
                    <input type="hidden" id="inid" name="id">

                    <div class="form-group">
                        <label for="">{{   __('Icon') }} **</label>
                        <div class="btn-group d-block">
                            <button type="button" class="btn btn-primary iconpicker-component"><i id="inicon"
                                    class=""></i></button>
                            <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                data-selected="fa-car" data-toggle="dropdown">
                            </button>
                            <div class="dropdown-menu"></div>
                        </div>
                        <input id="editinputIcon" type="hidden" name="icon" value="" class="in_icon">
                        <p id="eerricon" class="mb-0 text-danger em"></p>
                        <div class="mt-2">
                            <small>{{ __('NB: click on the dropdown icon to select a social link icon.') }}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{   __('Category Icon Color') . '*' }}</label>
                        <input class="jscolor form-control ltr" name="color" id="incolor">
                        <p id="editErr_color" class="mt-1 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for="">{{   __('Category Name') . '*' }}</label>
                        <input type="text" id="inname" class="form-control" name="name"
                            placeholder="Enter Category Name">
                        <p id="editErr_name" class="mt-1 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for="">{{   __('Category Status') . '*' }}</label>
                        <select name="status" id="instatus" class="form-control">
                            <option disabled>{{   __('Select a Status') }}</option>
                            <option value="1">{{  __('Active') }}</option>
                            <option value="0">{{   __('Deactive') }}</option>
                        </select>
                        <p id="editErr_status" class="mt-1 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for="">{{   __('Serial Number') . '*' }}</label>
                        <input type="number" id="inserial_number" class="form-control ltr" name="serial_number"
                            placeholder="Enter Category Serial Number">
                        <p id="editErr_serial_number" class="mt-1 mb-0 text-danger em"></p>
                        <p class="text-warning mt-2 mb-0">
                            <small>{{ __('The higher the serial number is, the later the category will be shown.') }}</small>
                        </p>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    {{   __('Close') }}
                </button>
                <button id="updateBtn" type="button" class="btn btn-primary btn-sm">
                    {{  __('Update') }}
                </button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $('.icp').on('iconpickerSelected', function(event) {
            $("#editinputIcon").val($("#inicon").attr('class'));
        });
    </script>
@endsection
