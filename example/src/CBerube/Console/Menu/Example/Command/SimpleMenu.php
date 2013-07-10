<?php

namespace CBerube\Console\Menu\Example\Command;

use CBerube\Console\Menu\Menu;
use CBerube\Console\Menu\MenuItem;
use CBerube\Console\Menu\MenuScreen;
use CBerube\Console\Menu\MenuScreenRenderer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SimpleMenu extends Command
{
    protected function configure()
    {
        $this
            ->setName('simple')
            ->setDescription("Display a simple menu sample");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var DialogHelper $dialog */
        $dialog = $this->getHelperSet()->get('dialog');

        $menu = $this->generateMenu();

        $menuScreen = new MenuScreen();
        $menuScreen->setMenu($menu);

        $renderer = new MenuScreenRenderer();
        $renderer->render($menuScreen, $output, $dialog);

        $selectedItem = $renderer->getSelectedItem();

        $output->writeln("You selected: ");
        $output->writeln(print_r($selectedItem, true));
    }

    /**
     * @return Menu
     */
    private function generateMenu()
    {
        $menu = new Menu();

        for ($i = 1; $i <= 10; $i++) {
            $item = new MenuItem();
            $item->setKey($i);
            $item->setDescription("Sample Item $i");
            $item->setValue($i);

            $menu->addItem($item);
        }

        return $menu;
    }
}
