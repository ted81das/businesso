<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{   __('Add Course Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="ajaxForm" class="modal-form create"
                    action="{{ route('user.course_management.store_category') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">{{   __('Language') . '*' }}</label>
                        <select name="user_language_id" class="form-control">
                            <option selected disabled>{{  __('Select a Language') }}
                            </option>
                            @foreach ($langs as $lang)
                                <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                            @endforeach
                        </select>
                        <p id="erruser_language_id" class="mt-1 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for="">{{   __('Category Icon') . '*' }}</label>
                        <div class="btn-group d-block">
                            <button type="button" class="btn btn-primary iconpicker-component">
                                <i class="fa fa-fw fa-heart"></i>
                            </button>
                            <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                data-selected="fa-car" data-toggle="dropdown"></button>
                            <div class="dropdown-menu"></div>
                        </div>

                        <input type="hidden" id="inputIcon" name="icon">
                        <p id="erricon" class="mt-1 mb-0 text-danger em"></p>

                        <div class="text-warning mt-2">
                            <small>{{ __('Click on the dropdown icon to select an icon for category.') }}</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{   __('Category Icon Color') . '*' }}</label>
                        <input class="jscolor form-control " name="color">
                        <p id="errcolor" class="mt-1 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for="">{{  __('Category Name') . '*' }}</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Category Name">
                        <p id="errname" class="mt-1 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for="">{{   __('Category Status') . '*' }}</label>
                        <select name="status" class="form-control">
                            <option selected disabled>{{   __('Select a Status') }}
                            </option>
                            <option value="1">{{  __('Active') }}</option>
                            <option value="0">{{  __('Deactive') }}</option>
                        </select>
                        <p id="errstatus" class="mt-1 mb-0 text-danger em"></p>
                    </div>

                    <div class="form-group">
                        <label for="">{{   __('Serial Number') . '*' }}</label>
                        <input type="number" class="form-control ltr" name="serial_number"
                            placeholder=" {{ __('Enter Serial Number') }}">
                        <p id="errserial_number" class="mt-1 mb-0 text-danger em"></p>
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
                <button id="submitBtn" type="button" class="btn btn-primary btn-sm">
                    {{   __('Save') }}
                </button>
            </div>
        </div>
    </div>
</div>
