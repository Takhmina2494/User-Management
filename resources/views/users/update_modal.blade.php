<!-- Modal -->
<div class="modal fade" id="update{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit" aria-hidden="true"></i> User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user-management.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <?php $id = $user->id; ?>
                    @if ($errors->$id->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->$id->all() as $error)
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
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email',$user->email) }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="name">Name
                                    <sup style="font-size:9px;"><i class="fa fa-asterisk text-danger"></i></sup>
                                </label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="{{ old('name',$user->name) }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="M" {{ old('gender',$user->gender) == 'M' ? 'selected' : '' }}>Male</option>
                                    <option value="F" {{ old('gender',$user->gender) == 'F' ? 'selected' : '' }}>Female</option>
                                    <option value="N" {{ old('gender',$user->gender) == 'N' ? 'selected' : '' }}>Rather Not Say</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="date_of_joining">Date of Joining
                                    <sup style="font-size:9px;"><i class="fa fa-asterisk text-danger"></i></sup>
                                </label>
                                <input type="date" name="date_of_joining" id="date_of_joining" class="form-control" value="{{ old('date_of_joining',Carbon\Carbon::parse($user->date_of_joining)->format('Y-m-d')) }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-check mt-3">
                                <input type="checkbox" name="working_flag" id="working_flag"  class="form-check-input" @if($user->date_of_leaving == null) checked @endif>
                                <label for="working_flag"  class="form-check-label">Still Working</label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="date_of_leaving">Date of Leaving
                                    <sup style="font-size:9px;"><i class="fa fa-asterisk text-danger"></i></sup>
                                </label>
                                <input type="date" name="date_of_leaving" id="date_of_leaving" class="form-control" @if($user->date_of_leaving == null) value="{{ old('date_of_leaving') }}" @else value="{{ old('date_of_leaving',Carbon\Carbon::parse($user->date_of_leaving)->format('Y-m-d')) }}" @endif>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4 pt-3" style="text-align:center;">
                                    @if($user->profile_image != null)
                                        <img src="{{ asset($user->profile_image) }}" alt="Profile Image" style="border-radius:40px;">
                                    @else
                                        @if($user->gender == 'M' || $user->gender == 'N')
                                            <img src="{{ asset('storage\user_images\m_avatar.png')}}" alt="Profile Image" style="width:100px;height:100px;border-radius:40px;">
                                        @else
                                        <img src="{{ asset('storage\user_images\f_avatar.png')}}" alt="Profile Image" style="width:100px;height:100px;border-radius:40px;">
                                        @endif
                                    @endif
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="profile_image">Profile Image</label>
                                        <input type="file" name="profile_image" id="profile_image" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>