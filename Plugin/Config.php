<?php

namespace Magepow\Promotionbar\Plugin;


class Config
{

 protected $activeEditor;


    public function __construct(\Magento\Ui\Block\Wysiwyg\ActiveEditor $activeEditor)
    {
        $this->activeEditor = $activeEditor;
    }

   
    public function afterGetConfig(
        \Magento\Ui\Component\Wysiwyg\ConfigInterface $configInterface,
        \Magento\Framework\DataObject $result
    ) {

        // Get current wysiwyg adapter's path
        $editor = $this->activeEditor->getWysiwygAdapterPath();

        // Is the current wysiwyg tinymce v4?
        if(strpos($editor,'tinymce4Adapter')){

        if (($result->getDataByPath('settings/menubar')) || ($result->getDataByPath('settings/toolbar')) || ($result->getDataByPath('settings/plugins'))){
           
            return $result;
        }

        $settings = $result->getData('settings');

        if (!is_array($settings)) {
            $settings = [];
        }

        // configure tinymce settings 
        $settings['menubar'] = true;
        $settings['toolbar'] = 'undo redo | styleselect | fontsizeselect | forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | code | formatselect | fontselect | fontsizeselect | cut | copy | paste | outdent | indent | blockquote | removeformat | subscript | superscript | visualaid | insert | hr | fullscreen | insertdatetime | flipv | fliph | editimage | imageoptions | rotateleft rotateright | table tabledelete tablecellprops tablecutrow tablecopyrow tablepasterowbefore tablepasterowafter tableinsertcolbefore tableinsertcolafter tabledeletecol ';
        $settings['plugins'] = 'textcolor image code table';

        $result->setData('settings', $settings);
        return $result;
        }
        else{ // don't make any changes if the current wysiwyg editor is not tinymce 4
            return $result;
        }
    }
}
