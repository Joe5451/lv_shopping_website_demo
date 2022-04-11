<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css?<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/fontawesome.css" />
    <script src="js/jquery-1.12.3.min.js"></script>
    <script src="js/tailwind.js"></script>
    <title>購物網站後台</title>
</head>
<body>

    <div class="flex items-center justify-center w-screen h-screen bg-teal-100 px-8">
        <form action="login" method="post" class="py-4 px-8 bg-white/75 rounded-md w-96 max-w-full">
            <div class="mb-4 text-center">
                <h1 class="text-2xl text-cyan-400 font-bold">TEMPLATE</h1>
                <h2 class="text-xl text-gray-400">管理者登入</h2>
            </div>

            <div class="mb-6 flex items-center">
                <label class="mr-4 shrink-0" for="account">帳號</label>
                <input type="text" id="account" class="border border-slate-400 focus:border-cyan-400 grow rounded px-4 py-1" name="account">
            </div>

            <div class="mb-6 flex items-center">
                <label class="mr-4 shrink-0" for="password">密碼</label>
                <input type="password" id="password" class="border border-slate-400 focus:border-cyan-400 grow rounded px-4 py-1" name="password">
            </div>

            @csrf

            <div class="flex justify-center items-center">
                <input type="submit" value="登入" class="bg-cyan-400 hover:bg-cyan-500 text-white py-1 px-4 rounded cursor-pointer transition duration-500">
            </div>
        </form>
    </div>

</body>