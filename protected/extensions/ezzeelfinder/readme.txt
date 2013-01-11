EZZE-ELFINDER

  Version: 2.0-rc1/0.0.1
  Author: Dmitriy Pushkov (ezze@ezze.org)
  Web-site: http://www.ezze.org
 

DESCRIPTION

  This extension allows you to integrate ElFinder file manager (http://elfinder.org)
  into your Yii web site's pages. Comparing with elfinder-widget
  (http://www.yiiframework.com/extension/elfinder-widget) extension this one is
  implementedwith an attempt to provide a more flexible way to configure both
  ElFinder's client and connector and to link the manager with WYSIWYG editor
  (only CKEditor is supported at the moment). The extension also relies on the latest
  release of ElFinder 2.0-rc1 (10th of April, 2012).


REQUIREMENTS

  The extension was written and tested with Yii 1.1.10 but it's up to you to try this
  one with the earlier version of the framework. Other requirements are all relative
  to ElFinder and depend on which features you need to support. For instance, one may
  wish to use PHP's FileInfo extension (http://php.net/manual/en/book.fileinfo.php)
  to check MIME-types of uploaded files.


INSTALLATION

  Extract an archive with the extension to directory of your web application's
  extensions. By default it's `protected/extensions`. As the result a new subdirectory
  named `ezzeelfinder` will appear in your extension's directory.


USAGE

  In order to use the extension one have to do the following simple steps:

  1). Create an action of a controller that will render a page with ElFinder. Let's
  suppose that controller class' name is `AdminController`, action function's name is
  `actionFileUploader` and action view's file is `views/fileUploader.php`.

  2). Implement `actions` method in `AdminController` as follows:

      public function actions()
      {
          return array(
              'fileUploaderConnector' => "ext.ezzeelfinder.ElFinderConnectorAction",
          );
      }

  where `fileUploaderConnector` is a name of action to refer to ElFinder's connector
  PHP script. Doing it the such way allows to restrict an access to ElFinder using
  controller's accessRules()
  (http://www.yiiframework.com/doc/api/1.1/CController#accessRules-detail).

  3). Insert a call of extension's widget in view file `fileUploader.php`. As an
  example, it may look like that:

      <div id="file-uploader"></div>

      <?php

      $filesPath = realpath(Yii::app()->basePath . "/../upload");
      $filesUrl = Yii::app()->baseUrl . "/upload";

      $this->widget("ext.ezzeelfinder.ElFinderWidget", array(
          'selector' => "div#file-uploader",
          'clientOptions' => array(
              'lang' => "ru",
              'resizable' => false,
              'wysiwyg' => "ckeditor"
          ),
          'connectorRoute' => "admin/fileUploaderConnector",
          'connectorOptions' => array(
              'roots' => array(
                  array(
                      'driver'  => "LocalFileSystem",
                      'path' => $filesPath,
                      'URL' => $filesUrl,
                      'tmbPath' => $filesPath . DIRECTORY_SEPARATOR . ".thumbs",
                      'mimeDetect' => "internal",
                      'accessControl' => "access"
                  )
              )
          )
      ));

      ?>

  There are four possible parameters that can be passed to the widget:

  `selector` - jQuery selector used to point to container element ElFinder must be
  appended to. This parameter is optional and defaults to `#elfinder`;

  `clientOptions` - an array of ElFinder's client configuration options described
  here: https://github.com/Studio-42/elFinder/wiki/Client-configuration-options.
  Please note, there is also `wysiwyg` possible option that is not supported by
  ElFinder but is used to let the extension know if ElFinder is to be linked with
  some WYSIWYG editor by setting `getFileCallback`
  (https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-getFileCallback)
  function. The reason to do it such way is that we cannot define a JavaScript
  function in PHP, and therefore we analyze `wysiwyg` option in ElFinder's
  initalization script `js/elFinderInit.js` of the extension and set the callback
  function there. As mentioned above, only `ckeditor` value is supported now but
  one can easily extend this script by adding callback functions for other WYSIWYG
  editors.

  `connectorRoute` - Yii route to ElFinder's connector action
  (`admin/fileUploaderConnector`).

  `connectorOptions` - an array of ElFinder's connector configuration options as
  described here: https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options.
  In the case of `LocalFileSystem` driver options `path` and `URL` of the `roots`
  are required to point to files' storage within file system and outside. By default
  `connectorOptions` parameter is equal to

      array(
          'roots' => array(
              array(
                  'driver'  => "LocalFileSystem",
                  'path' => realpath(Yii::app()->basePath . "/../files"),
                  'URL' => "/files",
                  'accessControl' => "access"
              )
          )
      )

  meaning that files' storage directory is `files` and located in the document root
  (supposing that Yii's application directory is also in the document root).

  `connectorOptions` are restricted by query string's length 'cause they are passed to
  ElFinder's connector action as serialized GET-parameter.

  Some people using `elfinder-widget` (http://www.yiiframework.com/extension/elfinder-widget)
  faced the problem of PHP FileInfo extension requirement. But not all servers'
  configurations support it. The problem can be solved by setting ElFinder's connector
  option `mimeDetect` to `internal` (as shown in code snippet above) forcing ElFinder
  to check uploaded files by their extensions only.


ADDITIONAL NOTES

  1). I recommend `ckeditor-integration` (http://www.yiiframework.com/extension/ckeditor-integration)
  extension to use ElFinder with CKEditor. In order to locate ElFinder from CKEditor
  extension use `filebrowserBrowseUrl`
  (http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html#.filebrowserBrowseUrl "filebrowserBrowseUrl")
  like this:

      $this->widget('ext.ckeditor.CKEditorWidget', array(
          'model' => $model,
          'attribute' => "body",
          'defaultValue' => $model->body,
          'config' => array(
              'height' => "400px",
              'width' => "100%",
              'language' => "ru",
              'filebrowserBrowseUrl' => $this->createUrl("admin/fileUploader")
          )
      )

  2). ElFinder core files are included in this extension so there is no need to download
  ElFinder. But one may wish to update these files by the latter ElFinder release by
  replacing `assets/css`, `assets/img`, `assets/js` and `php` directories of the
  extension by corresponding directories of ElFinder's new release.


RESOURCES

  ElFinder - http://elfinder.org
  CKEditor - http://ckeditor.com