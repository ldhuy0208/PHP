<?php include_once("header.php"); ?>
<?php include_once("nav.php"); ?>
<?php include_once("model/book.php"); ?>
<?php
    #Code bài số 4
    
    if(isset($_REQUEST['control']) && $_REQUEST['control'] == 'add'){
        if(!empty($_REQUEST['id']) 
                && !empty($_REQUEST['title']) 
                && !empty($_REQUEST['price']) 
                && !empty($_REQUEST['author']) 
                && !empty($_REQUEST['year'])){
            $book = new Book($_REQUEST['id'],
                                $_REQUEST['price'], 
                                $_REQUEST['title'], 
                                $_REQUEST['author'], 
                                $_REQUEST['year']);
            if(!Book::add($book)){
                echo '<script>alert("Trùng ID")</script>';
            }
        }
    }

    if(isset($_REQUEST['control']) && $_REQUEST['control'] == 'edit'){
        if(!empty($_REQUEST['id']) 
                && !empty($_REQUEST['title']) 
                && !empty($_REQUEST['price']) 
                && !empty($_REQUEST['author']) 
                && !empty($_REQUEST['year'])){
            $book = new Book($_REQUEST['id'],
                                $_REQUEST['price'], 
                                $_REQUEST['title'], 
                                $_REQUEST['author'], 
                                $_REQUEST['year']);
            Book::edit($book);
        }
        
    }
    
    if(isset($_REQUEST['control']) && $_REQUEST['control'] == 'delete'){
        Book::delete($_REQUEST['id']);
    }
    $booksFromFile = Book::getListFromFile($_REQUEST['search'] ?? '');
?>

<!-- Search form -->
<form>
    <div class="row mb-4">
        <div class="form-group col-md-9">
            <input name='search' type="text" placeholder="What're you searching for?" class="form-control form-control-underlined">
        </div>
        <div class="form-group col-md-3">
            <button type="submit" class="btn btn-outline-primary rounded-pill btn-block shadow-sm">Tìm kiếm</button>
        </div>
    </div>
</form>

<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-success rounded-pill shadow-sm float-right" data-toggle="modal" data-target="#add" >
    Thêm sách
</button>

<!-- Modal Thêm sách -->
<form action="">
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm một sách mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Body -->
                    <div class="form-group">
                        <label>ID:</label>
                        <input type="text" class="form-control" name='id'>
                    </div>
                    <div class="form-group">
                        <label>Tên sách:</label>
                        <input type="text" class="form-control" name='title'>
                    </div>
                    <div class="form-group">
                        <label>Giá:</label>
                        <input type="text" class="form-control" name='price'>
                    </div>
                    <div class="form-group">
                        <label>Tác giả:</label>
                        <input type="text" class="form-control" name='author'>
                    </div>
                    <div class="form-group">
                        <label>Năm xuất bản:</label>
                        <select name="year" class="browser-default custom-select" >
                        <option value="" disabled selected>Chọn năm xuất bản</option>
                        <?php
                            for($i=2019; $i>=2010; $i--){
                                echo "<option>".$i."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name='control' value='add' type="submit" class="btn btn-outline-success">Thêm</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>
</form>


<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Author</th>
            <th scope="col">Year</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
            foreach ($booksFromFile as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><?php echo $value->title ?></td>
                    <td><?php echo $value->price ?></td>
                    <td><?php echo $value->author ?></td>
                    <td><?php echo $value->year ?></td>
                    <td>
                        <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#edit-<?php echo $value->id;?>">Sửa</button>

                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-<?php echo $value->id; ?>">Xóa</button>
                        
                        <!-- modal xóa -->
                        <form action="">
                            <div class="modal fade" id="delete-<?php echo $value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Xác nhận</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Body -->
                                            
                                            <div class="form-group">
                                                <label>Bạn có muốn xóa sách "<?php echo $value->title; ?>" không?</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name = 'id' value = '<?php echo $value->id?>'></input>
                                            <button name='control' value='delete' type="submit" class="btn btn-outline-success">Xóa</button>
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- modal sửa -->
                        <form action="">
                            <div class="modal fade" id="edit-<?php echo $value->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Sửa thông tin sách</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Body -->
                                            <div class="form-group">
                                                <label>ID:</label>
                                                <input type="text" class="form-control" value='<?php echo $value->id; ?>' disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Tên sách:</label>
                                                <input type="text" class="form-control" name='title' value='<?php echo $value->title; ?>'>
                                            </div>
                                            <div class="form-group">
                                                <label>Giá:</label>
                                                <input type="text" class="form-control" name='price' value='<?php echo $value->price; ?>'>
                                            </div>
                                            <div class="form-group">
                                                <label>Tác giả:</label>
                                                <input type="text" class="form-control" name='author' value='<?php echo $value->author; ?>'>
                                            </div>
                                            <div class="form-group">
                                                <label>Năm xuất bản:</label>
                                                <select name="year" class="browser-default custom-select" >
                                                <option value='<?php echo $value->year; ?>' selected><?php echo $value->year; ?></option>
                                                <?php
                                                    for($i=2019; $i>=2010; $i--){
                                                        echo "<option>".$i."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" class="form-control" name='id' value='<?php echo $value->id; ?>'>
                                            <button name='control' value='edit' value='add' type="submit" class="btn btn-outline-success">Sửa</button>
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
            
    </tr>
    </tbody>
    
</table>

<?php include_once("footer.php") ?>