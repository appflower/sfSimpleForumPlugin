<?php use_helper('sfSimpleForum', 'Date') ?>
<tr>
  <td class="post_author">
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
      <br/>
    <?php endif; ?>
    <?php echo format_date($post->getCreatedAt('U')) ?>
  </td>
  <td class="post_message">
    <?php if ($include_topic): ?>
    <div class="post_details">
      <?php echo link_to($post->getsfSimpleForumForum()->getName(), 'sfSimpleForum/forum?forum_name='.$post->getsfSimpleForumForum()->getStrippedName()) ?>
     &raquo;
      <?php echo link_to($post->getTitle(), 'sfSimpleForum/post?id='.$post->getId()) ?>
      <?php endif ?>
    </div>
    <div class="post_content"><a name="post<?php echo $post->getId() ?>"></a>
      <?php echo $post->getContent() ?> 
    </div>
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
  </td>
</tr>
<tr class="spacer"><td colspan="2"></td></tr>