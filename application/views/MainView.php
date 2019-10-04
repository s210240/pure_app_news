<h4>Add news</h4>
<form action="add" method="post">
    <div class="form-group">
        <label for="InputHeader">Header</label>
        <input type="text" class="form-control" id="InputHeader" name="InputHeader" placeholder="Add header">
    </div>
    <div class="form-group">
        <label for="InputContent">Content</label>
        <input type="text" class="form-control" id="InputContent" name="InputContent" placeholder="Add content">
    </div>
    <input type="hidden" id="idNews" name="idNews"/>
    <div id="buttonNews" onclick="addNews()" class="btn btn-primary">Save news</div>
</form>
<p>
<h4 style="text-align: center">List News</h4>
</p>

<table id="mainTable" class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Header</th>
        <th scope="col">Content</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($data as $item) { ?>
        <tr id="i<?php echo $item['id'] ?>">
            <td><?php echo $item['header'] ?></td>
            <td><?php echo $item['content'] ?></td>
            <td><a id="editItem" onclick="editNews(<?php echo $item['id'] ?>)" href="#">Edit</a></td>
            <td><a href="#" id="deleteItem" onclick="deleteNews(<?php echo $item['id'] ?>)">Delete</a></td>
        </tr>

    <?php } ?>
    </tbody>
</table>

<ul class="pagination">
    <li><a href="?page=1"> First </a></li>
    <li class="<?php if ($page <= 1) {
        echo 'disabled';
    } ?>">
        <a href="<?php if ($page <= 1) {
            echo '#';
        } else {
            echo "?page=" . ($page - 1);
        } ?>"> | Prev </a>
    </li>
    <li class="<?php if ($page >= $total_pages) {
        echo 'disabled';
    } ?>">
        <a href="<?php if ($page >= $total_pages) {
            echo '#';
        } else {
            echo "?page=" . ($page + 1);
        } ?>"> | Next </a>
    </li>
    <li><a href="?page=<?php echo $total_pages; ?>"> | Last </a></li>
</ul>

<script>
    function addNews(type) {
        let header = $('#InputHeader').val();
        let content = $('#InputContent').val();

        if (header === '' || content === '') {
            alert('Cannot insert blank news');
        } else {

            $.ajax({
                url: 'main/save',
                type: "POST",
                data: {
                    header: header,
                    content: content,
                },
                success: function (data) {
                    console.log(data);
                    $('#mainTable > tbody:last').append('<tr id="' + data + '"><td>' + header + '</td>' + '<td>' + content + '</td>'
                        + '<td><a id="editItem" onclick="editNews(' + data + ')" href="#">Edit</a></td>'
                        + '<td><a href="#" id="deleteItem" onclick="deleteNews(' + data + ')">Delete</a></td></tr>'
                    );
                }
            });
        }
    }

    function editNews(id) {
        $('#buttonNews').html('Update News');
        let newFunc = "updateNews(" + id + ")";
        $("#buttonNews").attr("onclick", newFunc);

        $.ajax({
            url: 'main/edit',
            type: "POST",
            data: {
                id: id,
            },
            success: function (data) {
                console.log(data);
                let obj = jQuery.parseJSON(data);
                $('#InputHeader').val(obj[0].header);
                $('#InputContent').val(obj[0].content);

            }
        });
    }

    function deleteNews(id) {
        $.ajax({
            url: 'main/delete',
            type: "POST",
            data: {
                id: id,
            },
            success: function (data) {
                console.log(data);
                $('#i' + id).remove();
            }
        });
    }

    function updateNews(id) {
        let header = $('#InputHeader').val();
        let content = $('#InputContent').val();

        $.ajax({
            url: 'main/update',
            type: "POST",
            data: {
                id: id,
                header: header,
                content: content,
            },
            success: function (data) {

            }
        });
    }
</script>