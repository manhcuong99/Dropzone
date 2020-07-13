<!DOCTYPE html>
<html>

<head>
    <title>How to Upload a File using Dropzone.js with PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

    <body>
        <div class="container">
            <br />
            <h3 align="center">Sử dụng jquery upload file </h3>
            <br />

            <form action="upload.php" class="dropzone" id="dropzoneFrom">



            </form>
            <br />
            <br />
            <div align="center">
                <button type="button" class="btn btn-info" id="submit-all">Upload</button>
            </div>
            <br />
            <br />
            <div id="preview"></div>
            <br />
            <br />
        </div>
    </body>

</html>

<script>
    $(document).ready(function() {

        Dropzone.options.dropzoneFrom = {
 

        







          parallelUploads: 5,
          //  tải song song 5 ảnh liền lúc 
            autoProcessQueue: false,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            init: function() {
                var submitButton = document.querySelector('#submit-all');
                // document.querySelector('#submit-all') lấy phần tử đầu tiên của id 
                myDropzone = this;
                // đây là một Dropzone của tui  nó chứa hàng đợi 
             
                submitButton.addEventListener("click", function() {
                    myDropzone.processQueue();
                 //   location.reload();
                    //  processQueue() hàng đợi của cái object này được xử lí (true) vì ban đầu mình cho hàng đợi autoProcessQueue ko upload luôn đc 
                });
                this.on("complete", function() {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                      
                        _this.removeAllFiles();
                        // kiểm tra nếu  file đã và đang upload còn 0 thì xóa tất cả các hàng đợi là ảnh trong form đi 

                    }
                    list_image();
                    // hiển thi ra tất cả các file đã upload 
                });
            },
        };

        list_image();
        // load trang hiển thi ra luôn ảnh danh sách 

        function list_image() {
            $.ajax({
                url: "upload.php",
                success: function(data) {
                    $('#preview').html(data);
                }
            });
        }
       // cái data này là cái echo $output đó 

        $(document).on('click', '.remove_image', function() {
            var name = $(this).attr('id');
            // lấy id của thẻ sử dụng attr 
            console.log(name);
            $.ajax({
                url: "upload.php",
                method: "POST",
                data: {
                    name: name ,request: 1
                },
                success: function(data) {
                   
                    list_image();
                }
            })
        });

        // khi sử dụng click nó sẽ tìm id sử dụng ajax để lấy id và trả về list đã xóa 

        $(".dropzone").dropzone({
       addRemoveLinks: true,
       removedfile: function(file) {
           var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
         }

      
});

        

    });
</script>



<!-- Dropzone.js là một thư viện javascript và thư viện này không phụ thuộc vào bất kỳ thư viện nào khác như jquery.  -->
<!-- nó có tác dụng kéo thả chuột -->
<!-- phaỉ có class="dropzone" để có khung upload ảnh nhé  -->
<!--  Dropzone.options tác động đến id của form upload kiểu tác động đến kiểu  -->
<!-- chặn gửi  luôn autoProcessQueue :fasle -->
<!-- hàm init trong javascript nó là 1 hàm để hàm Một hàm init () cụ thể có thể được 
sử dụng để khởi tạo toàn bộ trang web, trong trường hợp đó, nó có thể được gọi từ document.
 Yet hoặc xử lý tải, hoặc có thể là để khởi tạo một loại đối tượng cụ thể, hoặc ... tốt, bạn gọi tên nó.
 -->