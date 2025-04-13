# Ecomerce_Shop

## Giới thiệu

Đây là một ứng dụng thương mại điện tử cơ bản được xây dựng bằng Laravel

### Yêu cầu hệ thống

Để chạy ứng dụng Laravel này, bạn cần cài đặt các phần mềm sau trên máy:

-   [PHP](https://www.php.net/)
-   [Composer](https://getcomposer.org/)

### Installation

1. Clone source về máY:
    ```bash
    git clone https://github.com/hilalahmad0101/ecomarce-website.git
    ```
2. Di chuyển vào thư mục dự án::

    ```bash
    cd Ecomerce_Shop
    ```

3.Cài đặt các thư viện PHP:
    ```bash
    composer install
    ```
4. Tạo file .env từ file mẫu và cấu hình thông tin cơ sở dữ liệu.
5.Tạo application key:
    ```bash
    php artisan key:generate
    ```
6. Chạy migration để tạo bảng dữ liệu:
    ```bash
    php artisan migrate
    ```
7. Chạy ứng dụng:
    ```bash
    php artisan serve
    ```
8. Chạy thử [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser to view the app.
