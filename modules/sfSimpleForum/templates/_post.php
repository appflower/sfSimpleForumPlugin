<?php use_helper('sfSimpleForum', 'Date') ?>

<div class="testingheader_box">
  <div class="lsb">

    <?php if (sfConfig::get('app_sfSimpleForumPlugin_show_author_details', false)): ?>
      <?php echo include_partial('sfSimpleForum/author', array('author_name' => $post->getAuthorName())) ?>
    <?php else: ?>
      <?php
        if($post->getUserId() != NULL)
        {
            echo link_to(
                get_partial('sfSimpleForum/author_name', array('author' => $post->getAuthorName())),
                'sfSimpleForum/userProfileLatestPosts?user_id='.$post->getUserId()
            );
        } else {
            echo $post->getAuthorName();
        }
      ?>

    <?php endif; ?>
    <?php echo format_date($post->getCreatedAt('U')) ?>
  </div>
  <div class="rsb">
    <?php if ($include_topic): ?>

      <?php echo link_to($post->getsfSimpleForumForum()->getName(), 'sfSimpleForum/forum?forum_name='.$post->getsfSimpleForumForum()->getStrippedName()) ?>
     &raquo;
      <?php echo link_to($post->getTitle(), 'sfSimpleForum/post?id='.$post->getId()) ?>
      <?php endif ?>


      <?php echo $post->getContent() ?> 

    <?php
      $dirUploadPath = sfConfig::get('sf_upload_dir').'/forum/'.$post->getId();
      if(file_exists($dirUploadPath)) {
          echo '<div class="post_file">';
              $fileDir = opendir($dirUploadPath);

              while ($fileName = readdir($fileDir))
              {
                  if($fileName != '.' && $fileName != '..') {
                      $fileUploadPath = $dirUploadPath.'/'.$fileName;

                      if( file_exists($fileUploadPath) ) {
                            $dirPath = '/uploads/forum/'.$post->getId();
                            $file = $dirPath.'/'.$fileName;
                            
                            echo link_to('Attached file', $file, array('target' => '_blank'));
                      }
                  }
              }
          echo '</div>';
      }
    ?>
    <?php if ($sf_user->hasCredential('moderator')): ?>
      <?php include_partial('sfSimpleForum/post_moderator_actions', array('post' => $post)) ?>
    <?php endif; ?>
  </div>
</div>
<div class="spacer"></div>