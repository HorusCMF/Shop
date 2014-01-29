<?php

namespace Horus\SiteBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Wks\SiteBundle\Entity\Meets;

/**
 * Remplisssage de Produits
 * CRON task 
 */
class ProduitsCommand extends ContainerAwareCommand {

    protected $maxNbMeets = 300;

    /**
     * Secure command linbe with param true
     */
    protected function configure() {
        $this->setName('produit:remplissage:meets')
                ->setDescription('Remplissage de datas')
                ->addArgument('activation', InputArgument::REQUIRED, 'Activation de la tâche?');
    }

    /**
     *  Execute command
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $start = microtime(true);
        //get EM
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $activation = $input->getArgument('activation');

        $jobOutput = new MemoryWriter();

        if ($activation) {

        }
        $end = microtime(true);
        $duration = sprintf("%0.2f", $end - $start);
        $output->writeln("Duration $duration seconds");

        $text = 'Remplissage effectuée';
        $output->writeln('<info>' . $text . '</info>');
    }
    
    
    /**
     * Interaction matchage
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function interact(InputInterface $input, OutputInterface $output) {
        
    }

}

?>
