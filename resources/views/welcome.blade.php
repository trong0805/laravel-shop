@extends('layout.master-client')
@section('title', 'Sản phẩm')
@section('content')
<script>
    function myFunction() {
        var element = document.getElementById("myDIV");
        element.classList.remove("nameContent");
        document.getElementById('ok').style.display = 'none';
    }
</script>
<div style="width: 100%; height: 300px;"></div>
<div style="Width: 200px;">
    <p id="myDIV" class="text-capitalize nameContent my-1">Bàn nước Bridge được thiết kế độc đáo với chất liệu hoàn toàn là gỗ sồi đặc. Kết cấu vững chắc và được kết nối thành một khối hình trọn vẹn, khéo léo mà không cần đến phụ kiện nào. Từng đường nét được xử lý tinh xảo kết hợp với màu sắc tự nhiên của gỗ sồi mang đến vẻ đẹp mộc mạc, gần gũi cho không gian phòng khách. Bridge – Tình yêu thiên nhiên và sức quyến rũ của gỗ. Bộ sưu tập Bridge mang hơi thở Scandinavian là sự kết hợp hoàn hảo của nhà thiết kế nổi tiếng Đan Mạch Hans Sandgren Jakobsen cùng công nghệ sản xuất thủ công của Nhật Bản. Mang thiết kế vượt thời gian, sử dụng chất liệu gỗ sồi và da bò tự nhiên, Bridge mang đến cảm giác sang trọng, gần gũi và thoải mái cho gia chủ. Điểm nổi bật của Bridge là sự tinh xảo trong hoàn thiện, từng chi tiết, những đường cong, bề mặt gỗ sồi được thực hiện và chọn lựa vô cùng kỹ càng, để tạo ra một Bridge hoàn hảo, chạm đến tâm hồn đầy cảm xúc và yêu quý những giá trị lâu bền của gia chủ Việt.</p>
    <a id="ok" onclick="myFunction()">Hiển thị</a>
</div>
@endsection