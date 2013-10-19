<?php
/**
 * Description of Html
 *
 * @author ratmir
 */
class Html extends CHtml
{
    /**
	 * Generates a button.
	 * @param string $label the button label
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated button tag
	 * @see clientChange
	 */
	public static function button($label='button', $htmlOptions=array())
	{
		if(!isset($htmlOptions['name']))
		{
			if(!array_key_exists('name',$htmlOptions))
				$htmlOptions['name']=self::ID_PREFIX.self::$count++;
		}
		if(!isset($htmlOptions['type']))
			$htmlOptions['type']='button';
        /*
		if(!isset($htmlOptions['value']))
			$htmlOptions['value']=$label;
        
        */
		self::clientChange('click',$htmlOptions);
		return self::tag('button',$htmlOptions, $label);
	}

	/**
	 * Generates a submit button.
	 * @param string $label the button label
	 * @param array $htmlOptions additional HTML attributes. Besides normal HTML attributes, a few special
	 * attributes are also recognized (see {@link clientChange} and {@link tag} for more details.)
	 * @return string the generated button tag
	 * @see clientChange
	 */
	public static function submitButton($label='submit',$htmlOptions=array())
	{
		$htmlOptions['type']='submit';
		return static::button($label,$htmlOptions);
	}
}

?>
