<?php
class Model_Users extends Orm\Model
{
    protected static $_primary_key = array('id');
    protected static $_table_name = 'users';
    protected static $_properties =
        array ('id',
               'username',
               'password',
               'group',
               'email',
               'last_login',
               'login_hash',
               'profile_fields',
               'created_at'
        );
};