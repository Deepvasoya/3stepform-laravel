@extends('layouts.app')

@section('content')
<style>
    .form-section{
            display: none;
    }
    .form-section.current{
        display: inherit;
    }
    .parsley-errors-list{
        margin: 2px 0 3px;
        padding: 0;
        list-style-type: none;
        color: red;
    }
     .error{
     color: #FF0000;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">{{ __('Employee Register') }}</div>
                <div class="card-body">
                    <!--progress-->
                    <div class="progress mb-5">
	                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>

                    <form method="POST" enctype='multipart/form-data' class="Employee-form"  action="{{ route('register') }}">
                      @csrf
                      <!--section-1-->
                      <div class="form-section section">
                          <h3 class="mb-5 text-center">Personal-Details</h3>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder='Enter name'>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder='Enter email'>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea type="text" id="exampleFormControlTextarea1 address" class="form-control @error('address') is-invalid  @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus  rows="2" placeholder='Enter address'></textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Your Profile Photo') }}</label>

                            <div class="col-md-6">
                                <input type="file" id="photo" class="form-control-file @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" required autocomplete="photo" onchange="showphoto(this)">
                                <img id="showImage"  style="max-width: 130px;margin-top: 20px;"/>
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder='Enter password'placeholder='Enter password'>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder='Repeat password'>
                            </div>
                        </div>

                       </div>



                    <!--section-2-->
                       <div class="form-section section">
                           <h3 class="mb-5 text-center">Technologies</h3>
                          <div class="form-group row">
                            <label for="Technologies" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Select Technologies Known') }}</label><br>

                            <div class="col-md-6">
                               <div class="d-flex justify-content-between">
                                   <input type="checkbox" name="Technologies[]" value="HTML"><label for="HTML">HTML</label>
                                   <input type="checkbox" name="Technologies[]" value="CSS"><label class="mx-2" for="CSS">CSS</label>
                                   <input type="checkbox" name="Technologies[]" value="PHP"><label for="PHP">PHP</label>
                                </div>
                               <div class="d-flex justify-content-between">
                                    <input type="checkbox" name="Technologies[]" value="Javascript"><label for="Javascript">Javascript</label>
                                    <input type="checkbox" name="Technologies[]" value="jquery"><label class="mx-3" for="jquery">jquery</label>
                                     <input type="checkbox" name="Technologies[]" value="C"><label class="mx-3"  for="C">c</label>

                               </div>
                               <div class="d-flex justify-content-between">
                                   <input type="checkbox" name="Technologies[]" value="Python"><label for="Python">Python</label>
                                   <input type="checkbox" name="Technologies[]" value="android"><label for="android">android</label>
                                   <input type="checkbox" name="Technologies[]" value="java"><label for="java">java</label>
                               </div>
                                <div class="d-flex justify-content-between">
                                    <input type="checkbox" name="Technologies[]" value="Angular"><label for="Angular">Angular</label>
                                    <input type="checkbox" name="Technologies[]" value="Node-js"><label for="Node-js">Node-js</label>
                                   <input type="checkbox" name="Technologies[]" value=".Net"><label for=".Net">.Net</label>


                               </div>
                                @error('Technologies')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           </div>
                       </div>


                    <!--section-3-->
                       <div class="form-section section">
                            <h3 class="mb-5 text-center">Companies And Experience</h3>
                            <div class="form-group row">
                                <label for="experience" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Total Year of experience') }}</label>
                                <div class="col-md-6">
                                    <input id="experience" type="text" class="form-control @error('experience') is-invalid @enderror" name="experience" value="{{ old('experience') }}" placeholder='Enter Total Year of experience' required autocomplete="experience" autofocus>

                                    @error('experience')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row wrapper">
                                 <label for="companies" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Companies Name and Experience With Year:') }}</label>
                              <div class="col-md-6">
                                <div class="element" id="companies-container">
                                <input type='text' name="companies[companie1][name]"  placeholder='Enter Companies name' class="form-control">
                                <input type='text' name="companies[companie1][year]"  placeholder='Enter Companies with Experience Year' class="form-control my-3">
                                </div>
                              </div>
                              <div class="col-md-6" style="margin-left: 285px;">
                                 <input type='button' class="clone"  id="clone" value='Add New Companies'>
                                 <input type='button' class="remo" value='Remove Companies'>
                              </div>
                            </div>

                            {{-- <div class="form-group row">
                                <div class="col-md-6 results" style="margin-left: 285px;">
                                </div>
                            </div> --}}
                        </div>
                       </div>
                        <div class="form-navigation">
                            <button type="button" class="previous btn btn-primary float-left mx-5 mb-5">Previous</button>
                            <button type="button" class="next btn btn-primary float-right mx-5 mb-5">Next</button>
                             <button type="submit" class="btn btn-success float-right mx-5 mb-5 sub">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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
<script>
     $(function(){

         var $sections = $('.form-section');

        var form_count = 0;
        total_forms = $(".section").length;

         function navigateTo(index){
            $sections.removeClass('current').eq(index).addClass('current');
            $('.form-navigation .previous').toggle(index>0);
             var atTheEnd = index >= $sections.length-1;
            $('.form-navigation .next') .toggle(!atTheEnd);
            $('.form-navigation [type=submit]') .toggle(atTheEnd);
            $('.remo').hide();
         }

         function curIndex(){
             return $sections.index($sections.filter('.current'))
         }

         $('.form-navigation .previous').click(function(){
            navigateTo(curIndex()-1);
            setProgressBar(--form_count);
         });

         $('.form-navigation .next').click(function(){
            $('.Employee-form').parsley().whenValidate({
                group: 'block-' + curIndex()
            }).done(function(){
                navigateTo(curIndex()+1);
                setProgressBar(++form_count);
            })
         });

         $sections.each(function(index,section){
             $(section).find(':input').attr('data-parsley-group','block-'+index);
         });

         navigateTo(0);


        setProgressBar(form_count);
        function setProgressBar(curStep){
        var percent = parseFloat(100 / total_forms) * curStep;
        percent = percent.toFixed();
        $(".progress-bar").css("width",percent+"%").html(percent+"%");
  }

        // $('.wrapper').on('click', '.clone', function() {
        //     $('.clone').closest('.wrapper').find('.element').first().clone().appendTo('.results').find("input[type='text']").val("");
        //     $('.remo').show();
        // });
        $('.wrapper').on('click', '.clone', function() {
             $('.remo').show();
        });

        $('.wrapper').on('click', '.remo', function() {
             $(".newClass:last").remove();
        });

        $('.sub').click(function(){
             $(".progress-bar").css("width","100%").html("100%");
         });
     });
</script>
<script>
let i = 2;
document.getElementById('clone').onclick = function () {
 let template = `
            <input type='text' name="companies[companie${i}][name]"  placeholder='Enter Companies name' class="form-control">
            <input type='text' name="companies[companie${i}][year]"  placeholder='Enter Companies with Experience Year' class="form-control my-3">
        `;
let container = document.getElementById('companies-container');
let div = document.createElement('div');
div.className = "newClass";
div.innerHTML = template;
container.appendChild(div);
i++;
};
</script>
<script>
    if ($("#Employee-form").length > 0) {
        $("#Employee-form").validate({

            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                },

                photo: {
                    required: true,
                },
                password: {
                    required: true,
                },
                experience: {
                    required: true,
                },
                companies: {
                    required: true,
                },
            },
            messages: {

                name: {
                    required: "Please enter name",
                },
                email: {
                    required: "Please enter valid email",
                },
                 photo: {
                    required: "Please select photo",
                },
                 password: {
                    required: "Please enter name",
                },
                experience: {
                    required: "Please enter experience",
                },
                companies: {
                    required: "Please enter companies and year of experience",
                },
            },
        })
    }
 </script>
@endsection

