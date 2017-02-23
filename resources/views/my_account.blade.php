<html>
    <head>
        <title>My Account</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        
    </head>
    <body>
        <img src="{{asset('uploads/thumbnail/').'/'.$user->photo}}">
        <div class="container">
            <div class="content">
                <span style="text-align: right; float: right;"><a href="<?php echo URL::to('/user/logout');?>">Logout</a></span>
                <a href="<?php echo URL::to('/user/logout');?>"></a>
                <?php if((Session::has('message'))){?>
                <span style="color: red;"><?php echo Session::get('message');?></span>
                <?php }?>
                <form action="image_upload" method="post" enctype="multipart/form-data">
                    <input name="_token" hidden value="{!! csrf_token() !!}" />
                <table>
                    
                    
                    <tr>
                        <td>Upload Profile Photo</td>
                        <td><input type="file" name="photo">
                        <span style="color: red;"><?php echo $errors->first('photo');?></span>
                        </td>
                    </tr>
                    
                     <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" value="Upload"></td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
    </body>
</html>
