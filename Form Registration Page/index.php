<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="name">Tên người dùng:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="phone">Điện thoại:</label><br>
        <input type="text" id="phone" name="phone"><br>
        <input type="submit" value="Đăng ký"><br><br>
    </form>
    <form method="get">
        <input type="submit" value="Hiển thị người dùng">
    </form>
    <?php

    function getUsers()
    {
        $data = file_get_contents('users.json');
        return json_decode($data, true);
    }

    $users = getUsers();

    function saveDataJSON($filename, $name, $email, $phone)
    {
        global $users;
        $contact = ["name" => $name, "email" => $email, "phone" => $phone];
        array_push($users, $contact);
        file_put_contents($filename, json_encode($users));
    }

    function displayUsers($users)
    {
    ?>
        <div>
            <?php
            // global $products;

            foreach ($users as $item => $user) : ?>
                <p>
                    <span>
                        <?php echo $user["name"]; ?>
                    </span>
                    <span>
                        <?php echo $user["email"]; ?>
                    </span>
                    <span>
                        <?php echo $user["phone"]; ?>
                    </span>
                    <span>
                </p>
            <?php endforeach; ?>
        </div>
    <?php
    }


    ?>
    <div>

    </div>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $check_name = false;
        $check_email = false;
        $check_phone = false;
        if (empty($name)): ?>
            <p>Không được để trống tên</p>
        <?php
        else:
            $check_name = true;
        endif;

        if (empty($email)) : ?>
            <p>Không được để trống email</p>
        <?php
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)): ?>
            <p>Nhập sai định dạng email</p>
        <?php
        else:
            $check_email = true;
        endif;

        if (empty($phone)) : ?>
            <p>Không được để trống phone</p>
    <?php
        else:
            $check_phone = true;
        endif;

        if ($check_name && $check_email && $check_phone) {
            saveDataJSON('users.json', $name, $email, $phone);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        global $users;
        displayUsers($users);
    }
    ?>

</body>

</html>