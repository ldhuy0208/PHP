<?php
class User{
    var $username;
    var $password;
    var $fullName;
    function __construct($username, $password, $fullName)
    {
        $this->username = $username;
        $this->password = $password;
        $this->fullName = $fullName;
    }

    /**
     * Xác thực người sử dụng
     * @param $username string Tên đăng nhập
     * @param $password string Mật khẩu
     * @return User hoặc null nếu không tồn tại
     */
    static function authentication($username, $password){
        if($username=='ldhuy0208' && $password=='123')
            return new User($username, $password, "Lê Huy");
        else return null;
    }
}

?>