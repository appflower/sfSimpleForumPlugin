<?php

/**
 * Subclass for representing a row from the 'sf_simple_forum_topic' table.
 *
 * 
 *
 * @package plugins.sfSimpleForumPlugin.lib.model
 */ 
class sfSimpleForumTopic extends PluginsfSimpleForumTopic
{
    public function __toString() {
        return $this->getTitle();
    }

    public function delete(PropelPDO $con = null, $latestPost = null)
    {
        $posts = $this->getPosts();

        foreach($posts as $post) {
            $postDir = $post->getId();
            $uploadDir = sfConfig::get('sf_upload_dir').'/forum/'.$postDir;

            if(file_exists($uploadDir)) {
                sfSimpleForumTools::unlinkRecursive($uploadDir);
            }
        }

        parent::delete($con, $latestPost);
    }
    
    public function getFeedLink()
    {
    	return sfContext::getInstance()->getController()->genUrl('sfSimpleForum/topic?id='.$this->getId().'&stripped_title='.$this->getStrippedTitle(), true);
    }
}
