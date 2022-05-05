<?php
$orderby_allowed_list = ['modified', 'date'];
$orderby = "modified";
if (isset($_GET['orderby']) && in_array($_GET['orderby'], $orderby_allowed_list)) {
    $orderby = $_GET['orderby'];
}
get_header();
?>
<div class="tag_container">

    <h1 class="title">
        نتایج برچسب
        <a href="#">
            <span>#<?php single_tag_title(); ?></span>
        </a>
    </h1>

    <div class="order_by_box">
        <form action="<?php echo  $current_url; ?>" method="GET">
            <label for="order" class="order">مرتب بر اساس:</label>
            <select name="orderby" class="order" id="orderby">
                <option <?php if ($orderby == "date") {
                            echo "selected";
                        } ?> value="date">تاریخ انتشار</option>
                <option <?php if ($orderby == "modified") {
                            echo "selected";
                        } ?> value="modified">تاریخ بروزرسانی</option>
                <option value="views">بازدید</option>
            </select>
        </form>
    </div>


    <div class="category_posts">
        <?php
        global $query;
        $tag_id = get_query_var('tag');
        $args = [
            "tag"           => $tag_id,
            "post_type"     => "post",
            "post_status"   => "publish",
            "orderby"       => $orderby
        ];
        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                set_query_var('query', $query);
                get_template_part('template-parts/content', 'none');
            }
        } else {
            echo "<h3 style='text-align:center;margin: 25px;'>نتیجه ای یافت نشد</h3>";
        }
        ?>
    </div>