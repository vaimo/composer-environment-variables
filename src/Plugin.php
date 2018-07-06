<?php
/**
 * Copyright © Vaimo Group. All rights reserved.
 * See LICENSE_VAIMO.txt for license details.
 */
namespace Vaimo\ComposerEnvironmentVariables;

use Vaimo\ComposerEnvironmentVariables\Config as PluginConfig;

class Plugin implements \Composer\Plugin\PluginInterface,
    \Composer\EventDispatcher\EventSubscriberInterface, \Composer\Plugin\Capable
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
            \Composer\Script\ScriptEvents::PRE_UPDATE_CMD => 'extractPatchesFromLock',
            \Composer\Script\ScriptEvents::PRE_INSTALL_CMD => 'extractPatchesFromLock'
        );
    }

    public function extractPatchesFromLock(\Composer\Script\Event $event)
    {
        if (!$this->bootstrap) {
            return;
        }

        $this->bootstrap->applyScope(PluginConfig::SCOPE_GLOBAL);
    }
}
