<?php echo form_tag('sfSimpleForum/add' . (isset($topic) ? 'Post' : 'Topic'), 'multipart=true id=add_topic class=jqtransform name=add_topic') ?>

  <?php
    if(!$sf_user->isAuthenticated())
    {
        if($author_name_error != '') {
            echo '<div id="error_for_author_name" class="form_error">
                    ↓&nbsp; The author cannot be left blank. Please enter some text &nbsp;↓
                 </div>';
        }
        
        echo '<div class="rowElem">';
            echo label_for('author_name', __('Author', null));
            echo input_tag('author_name', '', 'style=width:240px');
        echo '</div>';
    }
  ?>

  <?php if (isset($topic)): ?>
    
    <?php echo input_hidden_tag('topic_id', $topic->getId()) ?>
    
  <?php else: ?>

    <?php echo form_error('title') ?>
    <div class="rowElem">
        <?php echo label_for('title', __('Title', null, 'sfSimpleForum')) ?>
        <?php echo input_tag('title', '', 'id=topic_title') ?>
    </div>

    <div class="rowElem">
        <?php
            echo label_for('forum', __('Forum', null, 'sfSimpleForum'));
            $defaultForum = '';
            if($forum) {
                $defaultForum = $forum->getName();
            }
            echo select_tag('forum_name', options_for_select(sfSimpleForumForumPeer::getAllAsArray(), $defaultForum));
        ?>
    </div>

  <?php endif; ?>
  
  <?php echo form_error('body') ?>
  <div class="rowElem">
      <?php echo label_for('body', __('Body', null, 'sfSimpleForum')) ?>
      <?php echo textarea_tag('body', '', 'id=topic_body cols="25" rows="8"') ?>
      <div class="clear"></div>
  </div>

  <?php echo form_error('file') ?>
  <div class="rowElem">
      <?php echo label_for('file', __('Attach File', null, 'sfSimpleForum')) ?>
      <?php echo input_file_tag('file') ?>
  </div>

  <?php if (!isset($topic) && $sf_user->hasCredential('moderator')): ?>
    <div class="option">
      <?php echo checkbox_tag('is_sticked', '1')?>
      <?php echo label_for('is_sticked', __('Sticked topic', null, 'sfSimpleForum')) ?>
    </div>
    <div class="option">
      <?php echo checkbox_tag('is_locked', '1')?>
      <?php echo label_for('is_locked', __('Locked topic', null, 'sfSimpleForum')) ?>
    </div>
  <?php endif; ?>

    <?php
      if(!$sf_user->isAuthenticated())
      {
          use_helper('Validation');

          if($captcha_error != '') {
            echo '<div id="error_for_captcha" class="form_error">
                    ↓&nbsp; '.$captcha_error.' &nbsp;↓
                 </div>';
          }
          echo '<div class="rowElem">';
              echo label_for('captcha', __('Verify', null, 'sfSimpleForum'));
              echo '<img src="'.url_for('sfCaptcha/index').'" alt="captcha" />';
              echo input_tag('captcha');
          echo '</div>';
      }
    ?>

    <div class="rowElem">
        <label>&nbsp;</label>
        <?php echo submit_tag(__('Post', null, 'sfSimpleForum'), 'id=topic_submit') ?>
        <div class="clear"></div>
    </div>
  

  <br style ="clear:both"/>
</form>

