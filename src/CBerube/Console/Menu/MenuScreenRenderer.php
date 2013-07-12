<?php

namespace CBerube\Console\Menu;

use CBerube\Console\Screen\Clear\IScreenClearOperation;
use CBerube\Console\Screen\Geometry\IScreenGeometry;
use CBerube\Console\Screen\IScreen;
use CBerube\Console\Screen\IScreenRenderer;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;

class MenuScreenRenderer implements IScreenRenderer
{
    private $selectedItem;

    /** @var IScreenGeometry */
    private $screenGeometry;

    /** @var IScreenClearOperation */
    private $clearOperation;

    /** @var int */
    private $dividerInterval = 5;

    public function render(IScreen $screen, OutputInterface $output, DialogHelper $dialog)
    {
        $this->checkScreenType($screen);

        /** @var MenuScreen $screen */
        $menu = $screen->getMenu();

        $this->clearOperation->clear($output);
        $this->renderHeader($screen, $output);
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
        $screenGeometry = $this->getScreenGeometry();

        $formatter = new DefaultMenuItemFormatter();
        $menuGeometry = new MenuGeometry();

        $menuGeometry->setWidth($screenGeometry->getWidth());
        $menuGeometry->setHeight($screenGeometry->getHeight());

        $itemIndex = 0;

        /** @var $item MenuItem */
        foreach ($menu as $item) {
            if ($this->dividerInterval > 0 && $itemIndex > 0 && ($itemIndex % $this->dividerInterval) == 0) {
                $output->write(str_repeat('-', $menuGeometry->getWidth()));
            }

            $output->write($formatter->format($menuGeometry, $menu, $item));
            $itemIndex++;
        }

        $output->writeln('');
    }

    private function promptForChoice(OutputInterface $output, DialogHelper $dialog)
    {
        $result = $dialog->ask($output, "Enter your selection: ");
        return $result;
    }

    /**
     * @return IScreenGeometry
     */
    public function getScreenGeometry()
    {
        return $this->screenGeometry;
    }

    /**
     * @param IScreenGeometry $screenGeometry
     */
    public function setScreenGeometry($screenGeometry)
    {
        $this->screenGeometry = $screenGeometry;
    }

    /**
     * @return \CBerube\Console\Screen\Clear\IScreenClearOperation
     */
    public function getClearOperation()
    {
        return $this->clearOperation;
    }

    /**
     * @param \CBerube\Console\Screen\Clear\IScreenClearOperation $clearOperation
     */
    public function setClearOperation($clearOperation)
    {
        $this->clearOperation = $clearOperation;
    }

    /**
     * @param MenuScreen $menuScreen
     * @param OutputInterface $output
     */
    private function renderHeader(MenuScreen $menuScreen, OutputInterface $output)
    {
        $header = $menuScreen->getHeader();

        if (!empty($header)) {
            $totalWidth = $this->getScreenGeometry()->getWidth();
            $headerWidth = strlen($header);
            $leftPaddingWidth = ($totalWidth / 2) - ($headerWidth / 2);

            $headerDisplay = str_repeat(' ', $leftPaddingWidth) . $header;

            $output->writeln($headerDisplay);
            $output->write(str_repeat($menuScreen->getHeaderDivider(), $totalWidth));
            $output->writeln('');
        }
    }
}
