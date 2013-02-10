<?php
/**
 * ActiveRecord is the customized base CActiveRecord class.
 * 
 * The followings are the available columns
 * @property string $date_first
 * @property string $date_last
 */
class ActiveRecord extends CActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public $date_first;
    public $date_last;
    
    /**
    * @return array user type names indexed by type IDs
    */
    public function getStatusOptions()
    {
        return array(
            self::STATUS_INACTIVE  => 'Не опубликована',
            self::STATUS_ACTIVE => 'Опубликована',
        );
    }
    
    public function getStatusName($index)
    {
        $options = $this->getStatusOptions();
        return $options[$index];
    }
}

?>
