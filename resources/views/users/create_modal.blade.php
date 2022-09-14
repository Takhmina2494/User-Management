<!-- Modal -->
<div class="modal fade" id="create_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus" aria-hidden="true"></i> User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user-management.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if ($errors->createUser->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->createUser->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="email">Email
                                    <sup style="font-size:9px;"><i class="fa fa-asterisk text-danger"></i></sup>
                                </label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="name">Name
                                    <sup style="font-size:9px;"><i class="fa fa-asterisk text-danger"></i></sup>
                                </label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Male</option>
                                    <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female</option>
                                    <option value="N" {{ old('gender') == 'N' ? 'selected' : '' }}>Rather Not Say</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="date_of_joining">Date of Joining
                                    <sup style="font-size:9px;"><i class="fa fa-asterisk text-danger"></i></sup>
                                </label>
                                <input type="date" name="date_of_joining" id="date_of_joining" class="form-control" value="{{ old('date_of_joining') }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-check mt-3">
                                <input type="checkbox" name="working_flag" id="working_flag" class="form-check-input">
                                <label for="working_flag">Still Working</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="date_of_leaving">Date of Leaving
                                    <sup style="font-size:9px;"><i class="fa fa-asterisk text-danger"></i></sup>
                                </label>
                                <input type="date" name="date_of_leaving" id="date_of_leaving" class="form-control" value="{{ old('date_of_leaving') }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
