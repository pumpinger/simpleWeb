<?php
include 'head.php';
?>

<div class="content_area">
    <div class="area_w">
        <div class="search_form_w">
            <form action="" class="form-horizontal search_form clearfix">
                <div class="row">
                    <span class="r_name" >
                        account:
                    </span>
                    <input type="text" class="r_ipt" name="s_user" value=""/>
                </div>
                <div class="row r_sub_btn">
                    <button class="btn btn-info btn-sm" type="submit">
                        <i class="iconfont icon-search"></i>search
                    </button>
                </div>
            </form>
        </div>
        <div class="clearfix quick_btn">
            <a data-href="" data-original-title="add" class="btn btn-sm btn-primary edit_link">
                + add
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th width="50" class="center">ID</th>
                <th>account</th>
                <th>role</th>
                <th>status</th>
                <th>operation</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="center">1231</td>
                <td>123</td>
                <td>4234</td>
                <td>123</td>
                <td>
                    <a
                        data-href=""
                        data-title="edit"
                        class="btn btn-xs btn-info edit_link">
                        edit
                    </a>
                    <a
                        data-href=""
                        class="btn btn-xs btn-info ajax_link"
                        >
                        forbidden
                    </a>
                    <a data-href=""
                       class="btn btn-xs btn-info ajax_link">
                        start using
                    </a>
                    <a data-href=""
                       class="btn btn-xs btn-info delete_link">
                        delete
                    </a>


                </td>
            </tr>
            </tbody>
        </table>

        <div class="pager clearfix">
            <div class="fl">
                <div class="summary">10 rows.</div>
            </div>
            <div class="fr">
            </div>
        </div>
    </div>
</div>

<?php include 'foot.php';?>
