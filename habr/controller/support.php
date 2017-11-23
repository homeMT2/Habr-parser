<?php
/*
 * Home Table
 * */

function enqueue() {
    echo '<link href="' . config('site_url') . 'assets/css/style.css" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">';
}

function single_post() {
    $id = helper_url_section(2);
    $post = sql_select_post_by_id( $id );

    ?>

    <div class="parser-single-post">
        <div class="parser-back">
            <a href="<?php echo config('site_url'); ?>">
                Назад
            </a>
        </div>
        <?php echo htmlspecialchars_decode( $post['content'] ); ?>
    </div>

    <?php
}

function posts_table() {

    $posts = sql_select_all_posts( array( 'date' => post( 'sort_date' ) ) );

    ?>

    <form action="" class="sort" method="POST">
        <select name="sort_date">
            <option value="">--- По дате ---</option>
            <option value="DESC" <?php echo ( post( 'sort_date' ) == 'DESC' ) ? 'selected' : ''; ?> >Сначала новые</option>
            <option value="ASC"  <?php echo ( post( 'sort_date' ) == 'ASC'  ) ? 'selected' : ''; ?> >Вверху старые</option>
        </select>

        <input type="submit" value="Сортировать" />

    </form>

    <div class="posts">
        <table class="table">
            <thead>
                <tr>
                    <td class="table-id">ID</td>
                    <td class="table-post">Post ID</td>
                    <td class="table-title">Title</td>
                    <td class="table-url">URL</td>
                    <td class="table-tags">Tags</td>
                    <td class="table-date">Date</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach( $posts as $post ) : ?>
                    <?php
                        $tags = '';
                        $tags_id_array = unserialize( $post['tags'] );

                        foreach( $tags_id_array as $tag_id ) {
                            $tag = sql_select_tag_by_id( $tag_id )['tag_name'];
                            $tags .= $tag . ', ';
                        }
                        $tags = substr( $tags, 0, -2 );
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo config('site_url') . 'post/' . $post['id']; ?>">
                                <?php echo $post['id']; ?>
                            </a>
                        </td>
                        <td><?php echo $post['post_id'];    ?></td>
                        <td><?php echo $post['title'];      ?></td>
                        <td><a target="_blank" href="<?php echo $post['url']; ?>">HABR URL</a></td>
                        <td><?php echo $tags;               ?></td>
                        <td><?php echo date( config('time_format'), $post['post_publish'] );     ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php
}