<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @category  ZendService
 * @package   ZendService_Google\Gcm
 */

namespace ZendService\Google\Gcm;

use Zend\Json\Json;

/**
 * Google Cloud Messaging Notification
 * This class defines a Notification to be sent
 * through the Google Cloud Messaging API.
 *
 * @category   ZendService
 * @package    ZendService_Google
 * @subpackage Gcm
 */
class Notification
{
    /**
     * @var string
     */
    protected $title;
    
    /**
     * @var string
     */
    protected $body;
    
    /**
     * @var string
     */
    protected $icon;
    
    /**
     * @var string
     */
    protected $sound;
    
    /**
     * @var string
     */
    protected $tag;
    
    /**
     * @var string
     */
    protected $color;
    
    /**
     * @var string
     */
    protected $badge;
    
    /**
     * @var string
     */
    protected $clickAction;
    
    /**
     * @var string
     */
    protected $bodyLocKey;
    
    /**
     * @var array
     */
    protected $bodyLocArgs;
    
    /**
     * @var string
     */
    protected $titleLocKey;
    
    /**
     * @var array
     */
    protected $titleLocArgs;
    
    /**
     * Get notification title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     *
     * @param string $title
     * @return
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }
    
    /**
     * Get body text
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
    
    /**
     * Set body text
     *
     * @param string $body
     * @return Notification
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }
    
    /**
     * Get notification icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }
    
    /**
     * Set notification icon
     *
     * @param string $icon
     * @return Notification
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    
        return $this;
    }
    
    /**
     * Get sound to be played
     *
     * @return string
     */
    public function getSound()
    {
        return $this->sound;
    }
    
    /**
     * Set sound to be played
     *
     * @param string $sound
     * @return Notification
     */
    public function setSound($sound)
    {
        $this->sound = $sound;
    
        return $this;
    }
    
    /**
     * Get badge
     *
     * @return string
     */
    public function getBadge()
    {
        return $this->badge;
    }
    
    /**
     * Set badge
     *
     * @param string $badge
     * @return Notification
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
    
        return $this;
    }
    
    /**
     * Get Tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }
    
    /**
     * Set Tag
     *
     * @param string $tag
     * @return Notification
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    
        return $this;
    }
    
    /**
     * Set color of the icon
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }
    
    /**
     * Get color of the icon
     *
     * @param string $color
     * @return Notification
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }
    
    /**
     * Get action associated with a user click on the notification
     *
     * @return string
     */
    public function getClickAction()
    {
        return $this->clickAction;
    }
    
    /**
     * Set action associated with a user click on the notification
     *
     * @param string $clickAction
     * @return Notification
     */
    public function setClickAction($clickAction)
    {
        $this->clickAction = $clickAction;
    
        return $this;
    }
    
    /**
     * Get body localization key
     *
     * @return string
     */
    public function getBodyLocKey()
    {
        return $this->bodyLocKey;
    }
    
    /**
     * Set body localization key
     *
     * @param unknown $bodyLocKey
     * @return Notification
     */
    public function setBodyLocKey($bodyLocKey)
    {
        $this->bodyLocKey = $bodyLocKey;
    
        return $this;
    }
    
    /**
     * Get body localization args
     *
     * @return array
     */
    public function getBodyLocArgs()
    {
        return $this->bodyLocArgs;
    }
    
    /**
     * Set body localization args
     *
     * @param array $bodyLocArgs
     * @return Notification
     */
    public function setBodyLocArgs(array $bodyLocArgs)
    {
        $this->bodyLocArgs = $bodyLocArgs;
    
        return $this;
    }
    
    /**
     * Get title localization key
     *
     * @return string
     */
    public function getTitleLocKey()
    {
        return $this->titleLocKey;
    }
    
    /**
     * Set title localization key
     *
     * @param string $titleLocKey
     * @return Notification
     */
    public function setTitleLocKey($titleLocKey)
    {
        $this->titleLocKey = $titleLocKey;
    
        return $this;
    }
    
    /**
     * Set title localization args
     * 
     * @return array
     */
    public function getTitleLocArgs() 
    {
        return $this->titleLocArgs;
    }

    /**
     * Set title localization args
     * 
     * @param array $titleLocArgs
     * @return Notification
     */
    public function setTitleLocArgs(array $titleLocArgs) 
    {
        $this->titleLocArgs = $titleLocArgs;
        
        return $this;
    }

    /**
     * To ARRAY
     *
     * @return array
     */
    public function toArray()
    {
        $array = array();
        if ($this->title) {
            $array['title'] = $this->title;
        }
        if ($this->body) {
            $array['body'] = $this->body;
        }
        if ($this->icon) {
            $array['icon'] = $this->icon;
        }
        if ($this->sound) {
            $array['sound'] = $this->sound;
        }
        if ($this->badge) {
            $array['badge'] = $this->badge;
        }
        if ($this->tag) {
            $array['tag'] = $this->tag;
        }
        if ($this->color) {
            $array['color'] = $this->color;
        }
        if ($this->clickAction) {
            $array['click_action'] = $this->clickAction;
        }
        if ($this->bodyLocKey) {
            $array['body_loc_key'] = $this->bodyLocKey;
        }
        if ($this->bodyLocArgs) {
            $array['body_loc_args'] = $this->bodyLocArgs;
        }
        if ($this->titleLocKey) {
            $array['title_loc_key'] = $this->titleLocKey;
        }
        if ($this->titleLocArgs) {
            $array['title_loc_args'] = $this->titleLocArgs;
        }
        
        return $array;
    }
    /**
     * To JSON
     * Utility method to put the JSON into the
     * GCM proper format for sending the message notification.
     *
     * @return string
     */
    public function toJson()
    {
        return Json::encode($this->toArray());
    }
}
