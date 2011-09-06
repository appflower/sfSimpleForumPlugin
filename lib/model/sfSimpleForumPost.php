<?php

/**
 * Subclass for representing a row from the 'sf_simple_forum_post' table.
 *
 * 
 *
 * @package plugins.sfSimpleForumPlugin.lib.model
 */ 
class sfSimpleForumPost extends PluginsfSimpleForumPost
{
    public function delete(PropelPDO $con = null, $preserveTopic = true)
    {
        $postDir = $this->getId();
        $uploadDir = sfConfig::get('sf_upload_dir').'/forum/'.$postDir;

        if(file_exists($uploadDir)) {
            sfSimpleForumTools::unlinkRecursive($uploadDir);
        }

        parent::delete($con, $preserveTopic);
    }
}
