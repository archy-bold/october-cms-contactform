<?php namespace Archybold\ContactForm;

use System\Classes\PluginBase;

/**
 * ContactForm Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'archybold.contactform::lang.plugin.name',
            'description' => 'archybold.contactform::lang.plugin.description',
            'author'      => 'archybold',
            'icon'        => 'icon-envelope',
            'homepage'    => 'https://github.com/archy-bold/october-cms-contactform',
        ];
    }

    public function registerComponents(){
        return [
            'archybold\ContactForm\Components\ContactForm' => 'contactForm'
        ];
    }

}
