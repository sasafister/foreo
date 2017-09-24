<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AppSendEmailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:send-email')
            ->setDescription('...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $message = \Swift_Message::newInstance()
            ->setSubject('Foreo test')
            ->setFrom('sasa@zimo.co')
            ->setTo('sashafishter@gmail.com')
            ->setCharset('UTF-8')
            ->setContentType('text/html')
            ->setBody('Mail from command ...');

        $this->getContainer()->get('mailer')->send($message);
        $output->writeln('Success!');
    }

}
