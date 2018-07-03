<?php
/**
 * @package WordPress
 * @subpackage Synerzip
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
    <ol class="commentlist">
        <?php foreach ($comments as $comment) : ?>
        <li id="comment-<?php comment_ID() ?>">
            <div class="quote"><?php comment_text() ?></div>
            <?php if ($comment->comment_approved == '0') : ?>
            <em>Your comment is awaiting moderation.</em>
            <?php endif; ?>
            <cite>By: <?php comment_author(); ?> on <a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> at <?php comment_time() ?></a> <?php edit_comment_link('edit','&nbsp;&nbsp;',''); ?></cite>
        </li>
        <?php endforeach; ?>
    </ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<!--<p class="nocomments">Comments are closed.</p> -->

	<?php endif; ?>
<?php endif; ?>




<div id="respond">

<h2><?php comment_form_title( 'Leave a Comment', 'Leave a Comment to %s' ); ?></h2>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>
<form class="leave_box">
   
 <div class="form-group">
    <label for="name">  Name:</label>
 	<label style="color: red;">*</label>
<input type="text" class="form-control " id="usr" placeholder="Enter Name" style="height: 40px;">
    </div>

<div class="form-group">
      <label class="control-label " for="email">Email:</label>
	  <label style="color: red;">*</label>
        <input type="email" class="form-control comment_td" id="email" placeholder="Enter Email" name="email" style="height: 40px;">
    </div>
<?php endif; ?>
<div class="form-group">
     	<?php if ( !is_user_logged_in() ) : ?>
     <label for="comment">Comment:</label>
<?php endif; ?>
      <textarea class="form-control comment_td" rows="5" id="comment" placeholder="Comment"></textarea>
    </div>
<div class="form-group">        
      <div>
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
<?php do_action('comment_form', $post->ID); ?>
<?php comment_id_fields(); ?>
</form>

</form>


<?php endif; // If registration required and not logged in ?>

</div>


