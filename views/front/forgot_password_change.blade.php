@extends('front/layout');
@section('container')
<div class="container">
<div class="row col-md-6">
<form class="aa-login-form" action="" id="frmforgotpassword">
              <label for=""> Email address<span>*</span></label>
              <input type="password" name="forgot_password" placeholder="Password">
              <button class="aa-browse-btn" type="submit">Update</button>
              
              @csrf
      
            
              
            </form>
            <div id="msgforgot"></div>
</div></div>
@endsection;