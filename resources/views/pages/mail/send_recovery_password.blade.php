<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .recovery_password__link {
            font-family: Raleway-Medium;
            font-size: 1rem;
            padding: 10px;
            background: #000;
            color: #fff !important;
            border: 0;
            border-radius: 5px;
            text-align: center;
            width: 120px;
            text-decoration: none;
            margin: 7px 0;
        }
    </style>
</head>
<body>


    <div class="container">
        <div class="row">
            <div class="col">
                <div class="recovery_password">
                    <h3>
                        <img src="https://i.postimg.cc/gk93QK0R/2.png" alt="HERM-S">
                    </h3>

                    <span class="recovery_password__title">
                        HELLO {{ $data['name'] }}!
                    </span>

                    <p class="recovery_password__text">
                        Chúng tôi đã nhận được về việc muốn khôi phục lại mật khẩu từ bạn. Hãy nhấn vào ô dưới để đặt lại
                        mật khẩu!
                    </p>

                    <a class="recovery_password__link" href="{{ $data['link'] }}">Đặt lại mật khẩu</a>

                    <p class="recovery_password__text">
                        <img src="https://i.postimg.cc/2yqB09T7/exclamation-mark.png" width="15px" height="15px"
                            alt="exclamation-mark" class="recovery_password__img" />
                        Liên kết đặt lại mật khẩu này sẽ hết hạn sau 60 phút.
                    </p>

                    <p class="recovery_password__text">
                        Nếu bạn không yêu cầu đặt lại mật khẩu, không cần thực hiện bất kỳ hành động nào khác.
                    </p>

                    <p class="recovery_password__text">
                        Trân trọng,
                    </p>

                    <p class="recovery_password__text recovery_password__text--italic recovery_password__text--bold">
                        Gucci Shop
                    </p>

                    <hr>

                    <p class="recovery_password__text">
                        Nếu bạn gặp sự cố khi nhấp vào nút 'Đặt lại mật khẩu' thì hãy sao chép và dán URL bên dưới vào trình
                        duyệt web của bạn: <br>
                        {{ $data['link'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
