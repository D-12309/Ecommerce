@extends('front/layout');
@section('container')

<section id="aa-myaccount">
   <div class="container">
     <div class="row"> 
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <form action="" class="aa-login-form" id="frmregister">
                 <label for=""> Name <span>*</span></label>
                    <input type="text" name="name" id="name" placeholder="Name" >
                    <h6 id="name_error" class="field_error"></h6>
                    <label for=""> Email address<span>*</span></label>
                    <input type="email" name="email" id="email" placeholder="email" required>
                    <h6 id="email_error" class="field_error"></h6>

                    <label for="">Password<span>*</span></label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <h6 id="cat_name_error" class="field_error"></h6>
        
                    <label for=""> Phone<span>*</span></label>
                    <input type="text" name="phone" id="phone" placeholder="phone" required> 
                    <h6 id="phone_error" class="field_error"></h6>

                    @csrf
                    <button type="submit" id="frmsubmit" class="aa-browse-btn">Register</button>       
                    <h6 id="msg"  class="field_error"></h6>           
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
@endsection