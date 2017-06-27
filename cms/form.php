
<div class="body_box">
    <form class="normal_form" method="post" action="">
        <div class="row-group clearfix">
            <div class="data-group">
                <input type="hidden" value="<?php echo $referer_url; ?>" name="referer_url" id="referer_url">
            </div>
        </div>
        <div class="row-group clearfix">
            <label class="data-label" for="Chat_name">name:</label>
            <div class="data-group">
                <input type='text' value="<?php echo $model['name'];?>" name="Chat[name]" id="Chat_name" />
            </div>
        </div>
        <div class="row-group clearfix">
            <label class="data-label" for="Chat_location">location:</label>
            <div class="data-group">
                <input type='text' value="<?php echo $model['location'];?>" name="Chat[location]" id="Chat_location" />
            </div>
        </div>
        <div class="row-group clearfix">
            <label class="data-label" for="Chat_people">Principal:</label>
            <div class="data-group">
                <input type="text" value="<?php echo $model['people'];?>" name="Chat[people]" id="Chat_people" />
            </div>
        </div>

        <div class="row-group clearfix">
            <span class="data-label">&nbsp;</span>
            <div class="data-group" >
                <input class="btn btn-primary" type="submit" value="submit">
            </div>
        </div>



    </form>
    <div class="error">
        <?php echo $msg ?>
    </div>
</div>





