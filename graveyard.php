<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class GraveyardPlugin
 * @package Grav\Plugin
 */
class GraveyardPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPageNotFound' => ['onPageNotFound', 100],
            //'onGetPageTemplates' => ['onGetPageTemplates', 0],
        ];
    }
    /**
     * Display error page if no page was found for the current route.
     *
     * @param Event $event
     */
    public function onPageNotFound(Event $event)
    {
        $config = $this->grav['config'];
        $route = $this->grav['uri']->route();
        $graveyard = $config->get('plugins.graveyard.graveyard');
        
        $isdead = false;
        foreach ($graveyard as $link) {
            if (fnmatch($link, $route)) {
                $isdead = true;
                break;
            }
        }

        if ($isdead) {
            $this->enable([
                'onTwigTemplatePaths' => ['onTwigTemplatePaths', -10]
            ]);
            /** @var Pages $pages */
            $pages = $this->grav['pages'];
            // Try to load user error page.
            $page = $pages->dispatch($this->config->get('plugins.error.routes.410'), true);
            if (!$page) {
                // If none provided use built in error page.
                $page = new Page;
                $page->init(new \SplFileInfo(__DIR__ . '/pages/graveyard.md'));
            }
            $event->page = $page;
            $event->stopPropagation();
        }
    }
    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }
}
