<html>
    <head>
        <title>Register</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        
    </head>
    <body>
        <div class="container">
            <div class="content">
                <?php if((Session::has('message'))){?>
                <span style="color: red;"><?php echo Session::get('message');?></span>
                <?php }?>
                <form action="user/validateform" method="post">
                    <input name="_token" hidden value="{!! csrf_token() !!}" />
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name" >
                            <span style="color: red;"><?php echo $errors->first('name');?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email">
                        <span style="color: red;"><?php echo $errors->first('email');?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Mobile</td>
                        <td><input type="text" name="mobile">
                        <span style="color: red;"><?php echo $errors->first('mobile');?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password">
                        <span style="color: red;"><?php echo $errors->first('password');?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirm_password">
                        <span style="color: red;"><?php echo $errors->first('confirm_password');?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" value="Submit"></td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
    </body>
</html>
