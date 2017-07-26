<?php

/**
 * authors: Eric Schrock, Daniel Neri, Hannah Roper
 * date: April 9, 2017
 * title: sign_up.class.php
 * description: sign up class for users
 */
class SignUp extends UserIndexView {

    //put your code here
    public function display() {
        parent::displayHeader("Login / Sign Up");
        ?>

        <!--Begin HTML-->
        <div >

            <table id="signUp">
                <tr>
                    <td>
                        <!--This form logs the user sign-in-->
                        <form name="login" action='<?= BASE_URL ?>/user/verify' method="post">
                            <h2>Login</h2>
                            <table>
                                <tr>
                                    <th align="left">Username: </th>
                                    <td><input type="text" name="username" value="" /> </td>
                                </tr>
                                <tr>
                                    <th align="left">Password: </th>
                                    <td><input type="password" name="password" value="" /> </td>
                                </tr>
                            </table>
                            <br>
                            <input type="submit" name="action" value="Login">
                        </form>
                    </td>
                    <td>
                        <!--This form adds users to the database-->
                        <form name="newuser" action='<?= BASE_URL ?>/user/add' method="post">
                            <h2>Sign-up</h2>
                            <table>
                                <tr>
                                    <th align="right">Full Name: </th>
                                    <td><input type="text" name="fullname" /></td>
                                </tr>
                                <tr>
                                    <th align="right">Email: </th>
                                    <td><input type="text" name="email" /></td>
                                </tr>
                                <tr>
                                    <th align="right">Username: </th>
                                    <td><input type="text" name="new_username" /> </td>
                                </tr>
                                <tr>
                                    <th align="right">Password: </th>
                                    <td><input type="password" name="new_password" /> </td>
                                </tr>
                                <tr>
                                    <th align="right">Confirm Password: </th>
                                    <td><input type="password" name="confirm" /> </td>
                                </tr>
                            </table>
                            <br>
                            <input type="submit" name="action" value="Sign Up">
                        </form>
                    </td>

                </tr>         
            </table>


        </div>
        <?php
    }

}
