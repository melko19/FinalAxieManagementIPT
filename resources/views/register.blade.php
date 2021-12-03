@section('content')
@extends('base')
    <div class="col-md-5 form mt-5">
        <div class="register-form">
            <h1> Admin Registration</h1>
            <form action="{{url('/register')}}" method="post">
            {{csrf_field()}}
            
                <p>Name</p>
                    <input type="text" name="name" placeholder="Name">
                <p>Email</p>
                    <input type="text" name="email" placeholder="Email">

                <p>Password</p>
                    <input type="password" name="password" placeholder="Password">

                <button class="btn btn-primary" type="submit">Register</button>
            </form>
        </div>
    </div>

<style>
    .form{
        margin-left:38%;
    }
    body{
        background-image: url(../images/axiereg.png);
        width:100%;
        height:100%;
	    background-repeat: no-repeat;
    }
    .register-form{
        font-family: Garamond;
        top:20%;
        transform: translate(-5%, -5%);
        position:absolute;
        opacity:90%;
    }
    .register-form h1{
        color:white;
        font-size:40px;
        text-align:center;
        text-transform:uppercase;
        margin: 40px 0;
    }
    .register-form p{
        color:white;
        font-size:20px;
        margin:15px 0;
    }
    .register-form input{
        font-size:16px;
        width:100%;
        padding: 10px 10px;
        border: 0;
        outline:none;
        border-radius:5px;
    }
    .register-form button{
        box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.5);
        font-size: 18px;
        font-weight: bold;
        margin: 25px 0;
        padding:10px 20px;
        width: 45%;
        border-radius:10px;
    }
</style>

@stop