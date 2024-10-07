<?php
    // Mở và đọc file CSV, lưu vào mảng $array
    if (($open = fopen("text.csv", "r")) !== FALSE) {
        $array = []; // Đảm bảo mảng được khởi tạo
        while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
            $array[] = $data;
        }
        fclose($open);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Grid</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .card {
            width: 22%;
            margin-bottom: 20px;
            box-shadow: 0 0 10px 0 grey;
        }
        .card img {
            width: 100%;
            height: auto;
        }
        @media (max-width: 768px) {
            .card {
                width: 48%;
            }
        }
        @media (max-width: 576px) {
            .card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            // Duyệt qua mảng $array và tạo các thẻ HTML hiển thị
            foreach($array as $sub) {
                // Kiểm tra xem hình ảnh có thể tải được hay không
                $image_url = $sub[0];
                $headers = @get_headers($image_url);

                // Nếu không truy cập được hình ảnh, thay thế bằng thông báo "Image not available"
                if($headers && strpos($headers[0], '200')) {
                    echo '<div class="card">';
                    echo '<img src="' . $sub[0] . '" class="card-img-top" alt="Image">';
                } else {
                    echo '<div class="card">';
                    echo '<img src="https://inboundvietnam.com/files/files/Tour-noi-dia/ho-chi-minh/Saigon-Cyclo-Half-Day-Tour.jpg" class="card-img-top" alt="Image not available">';
                }

                // Hiển thị thông tin còn lại của tour
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-primary" style="font-family: Arial;">' . $sub[1] . '</h5>';
                echo '<p class="card-text"> <i class="fa-solid fa-clock text-primary"></i> ' . $sub[2] . '</p>';
                echo '<p class="card-text"> <i class="fa-solid fa-calendar-days text-primary"></i> ' . $sub[3] . '</p>';
                echo '<p class="card-text text-center text-success"> <i class="fa-solid fa-hand-holding-dollar text-danger"></i> ' . $sub[4] . '</p>';
                echo '<a href="#" class="btn btn-primary Book_now">Book now</a>';
                echo '</div></div>';
            }
        ?>
    </div>
</body>
</html>
