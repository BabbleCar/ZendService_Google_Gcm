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

use ZendService\Google\Exception;
use Zend\Json\Json;

/**
 * Google Cloud Messaging Message
 * This class defines a message to be sent
 * through the Google Cloud Messaging API.
 *
 * @category   ZendService
 * @package    ZendService_Google
 * @subpackage Gcm
 */
class Message
{
    
    /**
     * @const Notification PRIORITY normal
     */
    const PRIORITY_NORMAL = 'normal';
    
    /**
     * @const Notification PRIORITY high
     */
    const PRIORITY_HIGH = 'high';
    
    /**
     * @var string
     */
    protected $to;
    
    /**
     * @var array
     */
    protected $registrationIds = [];
    
    /**
     * 
     * @var string
     */
    protected $condition;
    
    /**
     * @var string
     */
    protected $collapseKey;

    /**
     * @var string
     */
    protected $priority;

    /**
     * @var bool
     */
    protected $contentAvailable;

    /**
     * @var int
     */
    protected $timeToLive = 2419200;
    
    /**
     * @var string
     */
    protected $restrictedPackageName;
    
    /**
     * @var bool
     */
    protected $dryRun = false;
    
    /**
     * @var array
     */
    protected $data = [];
    
    /**
     * 
     * @var Notification
     */
    protected $notification;
    
    /**
     * Set recipient of a message. 
     * 
     * @param string $to
     * @return Message
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }
    
    /**
     * Get recipient of a message.
     * 
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }
  
    /**
     * Set Registration Ids
     *
     * @param array $ids
     * @return Message
     */
    public function setRegistrationIds(array $ids)
    {
        $this->clearRegistrationIds();
        foreach ($ids as $id) {
            $this->addRegistrationId($id);
        }
        return $this;
    }
    
    /**
     * Get Registration Ids
     *
     * @return array
     */
    public function getRegistrationIds()
    {
        return $this->registrationIds;
    }
    
    /**
     * Add Registration Ids
     *
     * @param string $id
     * @return Message
     * @throws Exception\InvalidArgumentException
     */
    public function addRegistrationId($id)
    {
        if (!is_string($id) || empty($id)) {
            throw new Exception\InvalidArgumentException('$id must be a non-empty string');
        }
        if (!in_array($id, $this->registrationIds)) {
            $this->registrationIds[] = $id;
        }
        return $this;
    }
    
    /**
     * Clear Registration Ids
     *
     * @return Message
     */
    public function clearRegistrationIds()
    {
        $this->registrationIds = array();
        return $this;
    }
    
    /**
     * Set Condition
     *
     * @param string $condition
     * @return \ZendService\Google\Gcm\Message
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
        
        return $this;
    }
    
    /**
     * Get condition
     *
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }
    
    /**
     * Get Collapse Key
     *
     * @return string
     */
    public function getCollapseKey()
    {
        return $this->collapseKey;
    }
    
    /**
     * Set Collapse Key
     *
     * @param string $key
     * @return Message
     * @throws Exception\InvalidArgumentException
     */
    public function setCollapseKey($key)
    {
        if (!is_null($key) && !(is_string($key) && strlen($key) > 0)) {
            throw new Exception\InvalidArgumentException('$key must be null or a non-empty string');
        }
        $this->collapseKey = $key;
        return $this;
    }
    
    /**
     * Set the priority of the message.
     * Valid values are "normal" and "high."
     * 
     * @param string $priority
     * @return Message
     */
    public function setPriority($priority)
    {
        if($priority !== self::PRIORITY_HIGH && $priority !== self::PRIORITY_NORMAL) {
            throw new Exception\InvalidArgumentException('$priority must be "normal" or "high"');
        }
        
        $this->priority = $priority;

        return $this;
    }
    
    /**
     * Get the priority of the message.
     * 
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set content available
     * 
     * @param bool $contentAvailable
     * @return Message
     */
    public function setContentAvailable($contentAvailable)
    {
        $this->contentAvailable = (bool) $contentAvailable;
    
        return $this;
    }
    
    /**
     * Get content available
     * 
     * @return boolean
     */
    public function getContentAvailable()
    {
        return $this->contentAvailable;
    }

    /**
     * Set Time to Live
     *
     * @param int $ttl
     * @return Message
     */
    public function setTimeToLive($ttl)
    {
        $this->timeToLive = (int) $ttl;
        return $this;
    }
    
    /**
     * Get Time to Live
     *
     * @return int
     */
    public function getTimeToLive()
    {
        return $this->timeToLive;
    }
    
    /**
     * Set Restricted Package Name
     *
     * @param string $name
     * @return Message
     * @throws Exception\InvalidArgumentException
     */
    public function setRestrictedPackageName($name)
    {
        if (!is_null($name) && !(is_string($name) && strlen($name) > 0)) {
            throw new Exception\InvalidArgumentException('$name must be null OR a non-empty string');
        }
        $this->restrictedPackageName = $name;
        return $this;
    }
    
    /**
     * Get Restricted Package Name
     *
     * @return string
     */
    public function getRestrictedPackageName()
    {
        return $this->restrictedPackageName;
    }
    
    /**
     * Set Dry Run
     *
     * @param bool $dryRun
     * @return Message
     */
    public function setDryRun($dryRun)
    {
        $this->dryRun = (bool) $dryRun;
        return $this;
    }
    
    /**
     * Get Dry Run
     *
     * @return bool
     */
    public function getDryRun()
    {
        return $this->dryRun;
    }
    
    /**
     * Set Data
     *
     * @param array $data
     * @return Message
     */
    public function setData(array $data)
    {
        $this->clearData();
        foreach ($data as $k => $v) {
            $this->addData($k, $v);
        }
        return $this;
    }
    
    /**
     * Get Data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Add Data
     *
     * @param string $key
     * @param mixed $value
     * @return Message
     * @throws Exception\InvalidArgumentException
     * @throws Exception\RuntimeException
     */
    public function addData($key, $value)
    {
        if (!is_string($key) || empty($key)) {
            throw new Exception\InvalidArgumentException('$key must be a non-empty string');
        }
        if (array_key_exists($key, $this->data)) {
            throw new Exception\RuntimeException('$key conflicts with current set data');
        }
        $this->data[$key] = $value;
        return $this;
    }
    
    /**
     * Clear Data
     *
     * @return Message
     */
    public function clearData()
    {
        $this->data = array();
        return $this;
    }
    
    /**
     * 
     * @param Notification $notification
     * @return Message
     */
    public function setNotification($notification)
    {
        if (!$notification instanceof Notification) {
            throw new Exception\InvalidArgumentException('$notification must be a instance of Notification');
        }
        
        $this->notification = $notification;
    
        return $this;
    }
    
    /**
     * 
     * @return Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }
    
    /**
     * To JSON
     * Utility method to put the JSON into the
     * GCM proper format for sending the message.
     *
     * @return string
     */
    public function toJson()
    {
        $json = [];
        if ($this->to) {
            $json['to'] = $this->to;
        }
        if ($this->registrationIds) {
            $json['registration_ids'] = $this->registrationIds;
        }
        if ($this->registrationIds) {
            $json['registration_ids'] = $this->registrationIds;
        }
        if ($this->condition) {
            $json['condition'] = $this->condition;
        }
        if ($this->collapseKey) {
            $json['collapse_key'] = $this->collapseKey;
        }
        if ($this->priority) {
            $json['priority'] = $this->priority;
        }
        if ($this->contentAvailable) {
            $json['content_available'] = $this->contentAvailable;
        }
        if ($this->timeToLive != 2419200) {
            $json['time_to_live'] = $this->timeToLive;
        }
        if ($this->restrictedPackageName) {
            $json['restricted_package_name'] = $this->restrictedPackageName;
        }
        if ($this->dryRun) {
            $json['dry_run'] = $this->dryRun;
        }
        if ($this->data) {
            $json['data'] = $this->data;
        }
        if ($this->notification) {
            $json['notification'] = $this->notification->toArray();
        }
        
        return Json::encode($json);
    }
}
