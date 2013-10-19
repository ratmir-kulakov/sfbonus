<?php

class DateTimeBehavior extends CActiveRecordBehavior
{
    /**
     * @var mixed The name of the attribute to store the date.  Defaults to 'date_create'
     */
    public $dateAttribute = 'date_create';
    
    /**
     * @var mixed The name of the attribute to store the time.  Set to null to not
	 * use a DateTimeAR.  Defaults to 'time_create'
     */
    public $timeAttribute = 'time_create';
    
    /**
     * @var mixed The name of the attribute to store the timestamp 
     */
    public $timestampAttrbute = 'date_create';


    /**
     * @var string The format of the date attribute value  
     * Pattern:
     *     d    - Day of month 1 to 31, no padding
     *     dd   - Day of month 01 to 31, zero leading
     *     M    - Month digit 1 to 12, no padding
     *     MM   - Month digit 01 to 12, zero leading
     *     MMM  - Abbreviation representation of month (available since 1.1.11; locale aware since 1.1.13)
     *     MMMM - Full name representation (available since 1.1.13; locale aware)
     *     yy   - 2 year digit, e.g., 96, 05
     *     yyyy - 4 year digit, e.g., 2005
     */
    public $dateFormat = 'dd.MM.yyyy';
    
    /**
     * @var string The format of the time attribute value  
     * Pattern:
     *     h    - Hour in 0 to 23, no padding
     *     hh   - Hour in 00 to 23, zero leading
     *     H    - Hour in 0 to 23, no padding
     *     HH   - Hour in 00 to 23, zero leading
     *     m    - Minutes in 0 to 59, no padding
     *     mm   - Minutes in 00 to 59, zero leading
     *     s    - Seconds in 0 to 59, no padding
     *     ss   - Seconds in 00 to 59, zero leading
     *     a    - AM or PM, case-insensitive (since version 1.1.5)
     *     ?    - matches any character (wildcard) (since version 1.1.11)
     */
    public $timeFormat = 'hh:mm:ss';


    /**
	* Responds to {@link CModel::onBeforeValidate} event.
	*
	* @param CModelEvent $event event parameter
	*/
    public function beforeValidate($event)
    {
        if( $this->getOwner()->isAttributeRequired($this->timestampAttrbute) )
        {
            $this->getOwner()->{$this->timestampAttrbute} = $this->getTimestamp();
        }
        return parent::beforeValidate($event);
    }
    
    /**
	* Responds to {@link CModel::onBeforeSave} event.
	*
	* @param CModelEvent $event event parameter
	*/
    public function beforeSave($event)
    {
        if( ! $this->getOwner()->isAttributeRequired($this->timestampAttrbute) )
        {    
            $this->getOwner()->{$this->timestampAttrbute} = $this->getTimestamp();
        }
    }
    
    /**
     * Converts a date string to a timestamp
     * @return int
     */
    protected function getTimestamp()
    {
        $timestamp = 0;
        
        if( $this->timeAttribute === null )
        {
            $timestamp = CDateTimeParser::parse($this->getOwner()->{$this->dateAttribute}, $this->dateFormat);
        }
        else
        {
            $timestamp = CDateTimeParser::parse(
                $this->getOwner()->{$this->dateAttribute} . ' ' . $this->getOwner()->{$this->timeAttribute}, 
                $this->dateFormat . ' ' . $this->timeFormat
            );
        }
        
        return $timestamp;
    }
}

?>
