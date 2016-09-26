<?php

namespace MelvinLoos\DevVm;

use Composer\Installer\PackageEvent;
use Composer\Script\Event;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\PluginEvents;
use Composer\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

Class DevVm implements PluginInterface, EventSubscriberInterface
{
  static $vendorDir;

  public function activate(Composer $composer, IOInterface $io)
  {

  }

  public static function getSubscribedEvents()
  {
      return array(
          'post-install-cmd' => 'init',
          'post-update-cmd' => 'init',
      );
  }

  public function init(Event $event)
  {
    // init services
    $fs = new Filesystem();
    $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');

    try {
      // copy development machine files to root of project if it does not exist
      $files = array(
          array(
            'origin' => __DIR__.'/Resources/default.config.yml',
            'target' => $vendorDir.'/../dev-environment.yml'
          ),
          array(
            'origin' => __DIR__.'/Resources/Vagrantfile',
            'target' => $vendorDir.'/../Vagrantfile'
          )
        );
      foreach ($files as $path)
      {
        if (!$fs->exists($path['target']))
        {
          // TODO: print to CLI when files get copied
          $fs->copy($path['origin'],$path['target']);
        }
      }

    } catch (IOExceptionInterface $e) {
      echo "An error occurred while copying the following file ".$e->getPath().". Error message: ".$e->getMessage();
    }
  }
}
