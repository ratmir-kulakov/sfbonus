<?php

/**
 * Blocks displays the data from the database table "Blocks" that are assigned to 
 * a specific position.
 */
class BlocksWidget extends CWidget
{
    public $position = null;
    
    /**
     * @var string the name of the view (without file extension)
     */
    public $template = 'main';
    
    /**
     * @var bool If this is set as true, only one block will be displayed. Which 
     * block must be displayed is defined by weight (or priority) of item.
     */
    public $showOne = false;


    public function init()
    {
        parent::init();
        if( $this->position === null )
            throw new CException( Yii::t('customWidgets', 'For {widget} must be specified position.', 
                array('{widget}'=>get_class($this))));
        
    }
    
    public function run()
    {
        if( $this->showOne )
        {
            $blocks = Blocks::model()->getItemByPosition($this->position);
        }
        else
        {
            $blocks = Blocks::model()->getItemsByPosition($this->position);
        }
    }
}

?>
