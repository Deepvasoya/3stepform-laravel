@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">{{ __('Employee Dashboard') }}</div>
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    @if (session('status'))
                        <div class="alert alert-success successMessage" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id="success" class="alert alert-success d-none" role="alert"></div>
                  <div class="text-center">
                    <img style="border-radius: 50%;width:100px;" class="profile-user-img img-fluid img-circle user_picture" src="{{ asset('Profile') }}/{{ $authUser->photo  }}"  alt="User profile picture">
                    <h3 class="profile-username text-center admin_name">{{Auth::user()->name}}</h3>
                  <input type="file" name="user_image" id="user_image" style="opacity: 0;height:1px;display:none">
                  <a href="javascript:void(0)" class="btn btn-primary display:inline  btn-sm" id="change_picture_btn"><b>Change picture</b></a>
                  </div>
                </div>
            </div>
                <div class="card-body">
                     <h1 class="text-center" style="font-size: 25px;">My Profile</h1>
                     <table class="my-5 text-center" style="width:100%" id="usertable">
                            <tr>
                                <th>Name:</th>
                                <td id="tname">{{ $authUser->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td id="temail">{{ $authUser->email }}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td id="taddress">{{ $authUser->address }}</td>
                            </tr>
                            <tr>
                                <th>Technologies known:</th>
                                <td id="tTechnologies">{{ $authUser->Technologies }}</td>
                            </tr>
                             <tr>
                                <th>Year of experience:</th>
                                <td id=texperience>{{ $authUser->experience }}</td>
                            </tr>
                            <tr>
                                <th>Companies experience with year:</th>
                                <td class="d-none"></td>
                            </tr>
                            @php
                                $com = $authUser->companies;
                                $name = explode(",",$com);
                            @endphp
                                @foreach ($name as $val)
                                <tr>
                                    <th></th>
                                    <td id="tcompanies" class="mx-4">{{ $val }}</td>
                                 </tr>
                                @endforeach

                            <tr class="d-flex justify-content-center">
                               <td> <a href="javascript:void(0)" onclick="edituser()" class="btn btn-primary btn-sm my-5">Edit Profile</a></td>
                            </tr>
                     </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Edit User-profile Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  id="userEditdata" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $authUser->id }}">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" value="{{ $authUser->name }}" name="editname" id="editname">
                 <span class="text-danger" id="nameError"></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ $authUser->email }}" name="editemail" id="editemail">
                 <span class="text-danger" id="emailError"></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                 <textarea type="text" class="form-control"  name="editaddress" id="editaddress" rows="2">{{ $authUser->address }}</textarea>
                 <span class="text-danger" id="addressError"></span>
            </div>
             <div class="mb-3">
            <label class="form-label">Technologies known</label><br>
                @php
                $str = $authUser->Technologies;
                $val = explode(",",$str);
                @endphp
                  <div class="row">
                    <div class="col">
                    <input type="checkbox" class="form-check-input mx-5" value="HTML" @php if(in_array('HTML', $val)){echo'checked';}@endphp><label for="HTML">HTML</label>
                    </div>
                    <div class="col">
                      <input type="checkbox" class="form-check-input mx-5" value="CSS" @php if(in_array('CSS', $val)){echo'checked';}@endphp><label class="mx-2" for="CSS">CSS</label>
                    </div>
                    <div class="col">
                    <input type="checkbox" class="form-check-input mx-5" value="PHP" @php if(in_array('PHP', $val)){echo'checked';}@endphp><label for="PHP">PHP</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="checkbox" class="form-check-input mx-5" value="Javascript" @php if(in_array('Javascript', $val)){echo'checked';}@endphp><label for="Javascript">Javascript</label>
                    </div>
                    <div class="col">
                    <input type="checkbox" class="form-check-input mx-5" value="jquery" @php if(in_array('jquery', $val)){echo'checked';}@endphp><label class="mx-3" for="jquery">jquery</label>
                    </div>
                    <div class="col">
                    <input type="checkbox" class="form-check-input mx-5" value="C" @php if(in_array('C', $val)){echo'checked';}@endphp><label class="mx-3"  for="C">c</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                     <input type="checkbox" class="form-check-input mx-5" value="Python" @php if(in_array('Python', $val)){echo'checked';}@endphp><label for="Python">Python</label>
                    </div>
                    <div class="col">
                        <input type="checkbox" class="form-check-input mx-5" value="android" @php if(in_array('android', $val)){echo'checked';}@endphp><label for="android">android</label>
                    </div>
                    <div class="col">
                   <input type="checkbox" class="form-check-input mx-5" value="java" @php if(in_array('java', $val)){echo'checked';}@endphp><label for="java">java</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                   <input type="checkbox" class="form-check-input mx-5" value="Angular" @php if(in_array('Angular', $val)){echo'checked';}@endphp><label for="Angular">Angular</label>
                    </div>
                    <div class="col">
                    <input type="checkbox" class="form-check-input mx-5" value="Node-js" @php if(in_array('Node-js', $val)){echo'checked';}@endphp><label for="Node-js">Node-js</label>
                    </div>
                    <div class="col">
                    <input type="checkbox" class="form-check-input mx-5" value=".Net" @php if(in_array('.Net', $val)){echo'checked';}@endphp><label for=".Net">.Net</label>
                    </div>
                </div>
                 <span class="text-danger" id="TechnologiesError"></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Total Year of Experience:</label>
                <input type="text" class="form-control" value="{{ $authUser->experience  }}" name="editexperience" id="editexperience">
                 <span class="text-danger" id="experienceError"></span>
            </div>
            <div class="mb-3">
                <label class="form-label">Companies Name and Experience With Year:</label>
                 <textarea type="text" class="form-control" value="{{ $authUser->companies  }}" name="editcompanies" id="editcompanies" rows="2">{{ $authUser->companies  }}</textarea>
                 <span class="text-danger" id="companiesError"></span>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Update Profile</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script  type="text/javascript">
$(document).ready(function(){
     $(".successMessage").slideDown(300).delay(3000).slideUp(300);
});
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

  $(function(){
       $(document).on('click','#change_picture_btn', function(){
             $('#user_image').click();
            });

    });

     $('#user_image').ijaboCropTool({
          preview : '.user_picture',
          setRatio:1,
          allowedExtensions: ['jpg', 'jpeg','png'],
          buttonsText:['CROP','QUIT'],
          buttonsColor:['#30bf7d','#ee5155', -15],
          processUrl:'{{ route("user.photo") }}',
          // withCSRF:['_token','{{ csrf_token() }}'],
          onSuccess:function(message, element, status){
             alert(message);
          },
          onError:function(message, element, status){
            alert(message);
          }
       });
</script>
<script type="text/javascript">
         function edituser()
         {
            $("#userEditModal").modal('toggle');
         }
         $(document).on("submit","#userEditdata", function(e){
              e.preventDefault();
              let _token = $("input[name=_token]").val();
              let id = $("#id").val();
              let name = $("#editname").val();
              let email = $("#editemail").val();
              let address = $("#editaddress").val();
              let experience = $("#editexperience").val();
              let companies = $("#editcompanies").val();
                var Technologies = [];
                $(".form-check-input").each(function(){
                    if ($(this).is(":checked")) {
                        Technologies.push($(this).val());
                    }
                });
                Technologies = Technologies.toString();

               $.ajax({
                url:"{{ route('update') }}",
                type:'POST',
                data:{
                    id:id,
                    name:name,
                    email:email,
                    address:address,
                    Technologies:Technologies,
                    experience:experience,
                    companies:companies,
                    _token:_token
                },
                success:function(response){
                    $("#userEditModal").modal('toggle');
                    $("#userEditdata")[0].reset();
                     $("#success").text(response.success);
                        $("#success").removeClass("d-none");
                        setTimeout(function() { $("#success").hide().html(''); }, 8000);
                        setInterval(function(){
                                location.reload();
                            }, 2000);
                    },
                       error: function (response) {
                    $("#nameError").text(response.name);
                    $("#emailError").text(response.email);
                    $("#addressError").text(response.address);
                    $("#TechnologiesError").text(response.Technologies);
                    $("#experienceError").text(response.experience);
                    $("#companiesError").text(response.companies);
                }
             });
         });
</script>
<script>
  function showphoto(input){
       var photos = $("input[type=file]").get(0).files[0];
       if(photos){
           var reader = new FileReader();
           reader.onload = function(){
               $('#showImage').attr("src",reader.result);
           }
           reader.readAsDataURL(photos);
       }
  }
</script>
@endsection
