<?php

/**
 * Description of HttpRequest
 *
 * @author ratmir
 */
class HttpRequest extends CHttpRequest
{
    private $_csrfToken;
 
    /**
	 * Returns the random token used to perform CSRF validation.
	 * The token will be read from session first. If not found, a new token
	 * will be generated.
	 * @return string the random token for CSRF validation.
	 * @see enableCsrfValidation
	 */
    public function getCsrfToken()
    {
        if($this->_csrfToken===null)
        {
            $session = Yii::app()->session;
            $csrfToken = $session->itemAt($this->csrfTokenName);
            if($csrfToken===null)
            {
                $csrfToken = sha1(uniqid(mt_rand(),true));
                $session->add($this->csrfTokenName, $csrfToken);
            }
            $this->_csrfToken = $csrfToken;
        }

        return $this->_csrfToken;
    }
    
    /**
	 * Performs the CSRF validation.
	 * This is the event handler responding to {@link CApplication::onBeginRequest}.
	 * The default implementation will compare the CSRF token obtained
	 * from a session and from a POST field. If they are different, a CSRF attack is detected.
	 * @param CEvent $event event parameter
	 * @throws CHttpException if the validation fails
	 */
    public function validateCsrfToken($event)
    {
        if($this->getIsPostRequest())
        {
            // only validate POST requests
            $session = Yii::app()->session;
            if($session->contains($this->csrfTokenName) && isset($_POST[$this->csrfTokenName]))
            {
                $tokenFromSession=$session->itemAt($this->csrfTokenName);
                $tokenFromPost=$_POST[$this->csrfTokenName];
                $valid=$tokenFromSession===$tokenFromPost;
            }
            else
                $valid=false;
            if(!$valid)
                throw new CHttpException(400,Yii::t('yii','The CSRF token could not be verified.'));
        }
    }
}

?>