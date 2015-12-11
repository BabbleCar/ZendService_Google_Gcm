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
 * Google Cloud Messaging Device Group
 * through the Google Cloud Messaging API.
 *
 * @category   ZendService
 * @package    ZendService_Google
 * @subpackage Gcm
 */
class DeviceGroup
{
    /**
     * @var string
     */
    protected $operation;
    
    /**
     * @var string
     */
    protected $notificationKeyName;
    
    /**
     * @var string
     */
    protected $notificationKey;
    
    /**
     * @var array
     */
    protected $registrationIds;
    
    /**
     * Returns the operation value.
     *
     * @return  string
     */
    public function getOperation() 
    {
        return $this->operation;
    }
     
    /**
     * Set the operation value.
     *
     * @param string $operation
     */
    public function setOperation($operation) 
    {
        $this->operation = $operation;
        
        return $this;
    }
    
    /**
     * Returns the notificationKeyName value.
     *
     * @return  type
     */
    public function getNotificationKeyName()
    {
        return $this->notificationKeyName;
    }
     
    /**
     * Set the notificationKeyName value.
     *
     * @param type $notificationKeyName
     */
    public function setNotificationKeyName($notificationKeyName)
    {
        $this->notificationKeyName = $notificationKeyName;
    
        return $this;
    }
    
    /**
     * Returns the notificationKey value.
     *
     * @return  type
     */
    public function getNotificationKey()
    {
        return $this->notificationKey;
    }
     
    /**
     * Set the notificationKey value.
     *
     * @param type $notificationKey
     */
    public function setNotificationKey($notificationKey)
    {
        $this->notificationKey = $notificationKey;
    
        return $this;
    }
    
    /**
     * Returns the registrationIds value.
     *
     * @return  type
     */
    public function getRegistrationIds()
    {
        return $this->registrationIds;
    }
     
    /**
     * Set the registrationIds value.
     *
     * @param type $registrationIds
     */
    public function setRegistrationIds(array $registrationIds)
    {
        $this->registrationIds = $registrationIds;
    
        return $this;
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
        $json = array();
        if ($this->operation) {
            $json['operation'] = $this->operation;
        }
        if ($this->notificationKeyName) {
            $json['notification_key_name'] = $this->notificationKeyName;
        }
        if ($this->notificationKey) {
            $json['notification_key'] = $this->notificationKey;
        }
        if ($this->registrationIds) {
            $json['registration_ids'] = $this->registrationIds;
        }
        
        return Json::encode($json);
    }
}
