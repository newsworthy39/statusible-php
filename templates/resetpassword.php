<?php $this->layout('template', ['title' => 'Reset Password']) ?>

<div class="container">

<?php $this->insert('snippets/navigationbar', ['title' => 'Dashboard']); ?>

    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-5">Reset password</h1>
        <form class="form-signin" METHOD="POST">
            <label for="inputPassword" class="sr-only">New password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="New password" required autofocus>
            <label for="inputPasswordRepeat" class="sr-only">Repeat password</label>
            <input type="password" id="confirm_password" class="form-control" placeholder="Confirm password" required>
            <input type="hidden" id="token" class="form-control" value="<?=$this->e($token)?>">
            <br />
            <button class="btn btn-lg btn-primary btn-block" type="submit">Change Password</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
        </form>
    </div>
    <script type="text/javascript">
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirm_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>

    <?php $this->insert('snippets/footer', ['acceptCookies' => false]); ?>    
</div>