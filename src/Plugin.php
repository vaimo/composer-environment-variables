<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */
namespace Vaimo\ComposerEnvironmentVariables;

use Vaimo\ComposerEnvironmentVariables\Config as PluginConfig;

class Plugin implements \Composer\Plugin\PluginInterface,
    \Composer\EventDispatcher\EventSubscriberInterface
{
    /**
     * @var \Vaimo\ComposerEnvironmentVariables\Bootstrap
     */
    private $bootstrap;

    public function activate(\Composer\Composer $composer, \Composer\IO\IOInterface $io)
    {
        $this->bootstrap = new \Vaimo\ComposerEnvironmentVariables\Bootstrap($composer);
    }

    public static function getSubscribedEvents()
    {
        return array(
            \Composer\Script\ScriptEvents::PRE_UPDATE_CMD => 'registerEnvironmentVariables',
            \Composer\Script\ScriptEvents::PRE_INSTALL_CMD => 'registerEnvironmentVariables'
        );
    }

    public function registerEnvironmentVariables(\Composer\Script\Event $event)
    {
        if (!$this->bootstrap) {
            return;
        }

        $this->bootstrap->applyScope(PluginConfig::SCOPE_GLOBAL);
    }
}
