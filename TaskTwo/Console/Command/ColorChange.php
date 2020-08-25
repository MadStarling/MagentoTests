<?php
/**
 * A Magento 2 module named Starling/TaskTwo
 * Copyright (C) 2019 
 * 
 * This file included in Starling/TaskTwo is licensed under OSL 3.0
 * 
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */

namespace Starling\TaskTwo\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ColorChange extends Command
{

    const COLOR_ARGUMENT = "color";

    /**
     *
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     */
    public function __construct(\Magento\Framework\App\Config\Storage\WriterInterface $configWriter)
    {
        $this->configWriter = $configWriter;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $color = $input->getArgument(self::COLOR_ARGUMENT);
        if(strlen($color) > 0 && $this->validateColor($color)) {
            $this->configWriter->save('tasktwo/general/color',  $color, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
            $output->writeln("New color code is " . $color);
        } else $output->writeln($color . " is not a valid hex code for a color.");
    }

    protected function validateColor($colorCode)
    {
       return preg_match("/#([a-f0-9]{3}){1,2}\b/i", $colorCode) === 1;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("starling_tasktwo:colorchange");
        $this->setDescription("Change the colors of all the buttons");
        $this->setDefinition([
            new InputArgument(self::COLOR_ARGUMENT, InputArgument::OPTIONAL, "color")
        ]);
        parent::configure();
    }
}
