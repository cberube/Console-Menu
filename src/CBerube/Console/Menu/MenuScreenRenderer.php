<?php

namespace CBerube\Console\Menu;

use CBerube\Console\Screen\IScreen;
use CBerube\Console\Screen\IScreenRenderer;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;

class MenuScreenRenderer implements IScreenRenderer
{
    private $selectedItem;

    public function render(IScreen $screen, OutputInterface $output, DialogHelper $dialog)
    {
        $this->checkScreenType($screen);

        /** @var MenuScreen $screen */
        $menu = $screen->getMenu();

        $this->renderMenuItems($menu, $output);

        $selectedItemKey = $this->promptForChoice($output, $dialog);
        $this->selectedItem = $menu->getItemByKey($selectedItemKey);
    }

    /**
     * @return MenuItem|null
     */
    public function getSelectedItem()
    {
        return $this->selectedItem;
    }

    private function checkScreenType(IScreen $screen)
    {
        if (!($screen instanceof MenuScreen)) {
            throw new \InvalidArgumentException(
                __CLASS__ . " requires an instance of \\CBerube\\Console\\Menu\\MenuScreen but" .
                "was given an instance of " . get_class($screen)
            );
        }
    }

    private function renderMenuItems(IMenu $menu, OutputInterface $output)
    {
        /** @var $item MenuItem */
        foreach ($menu as $key => $item) {
            $output->writeln("$key) {$item->getDescription()}");
        }
    }

    private function promptForChoice(OutputInterface $output, DialogHelper $dialog)
    {
        $result = $dialog->ask($output, "Enter your selection: ");
        return $result;
    }
}
