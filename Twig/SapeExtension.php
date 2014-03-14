<?php

namespace Anh\SapeBundle\Twig;

use Anh\SapeBundle\Sape\SapeClient;

class SapeExtension extends \Twig_Extension
{
    /**
     * Constructor
     */
    public function __construct(SapeClient $sapeClient)
    {
        $this->sapeClient = $sapeClient;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            // SAPE_client
            new \Twig_SimpleFunction('sape_return_links', array($this, 'return_links')),
            new \Twig_SimpleFunction('sape_return_block_links', array($this, 'return_block_links')),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'anh_sape';
    }

    public function return_links($n = null, $offset = 0, $options = null)
    {
        return $this->sapeClient->return_links($n, $offset, $options);
    }

    public function return_block_links($n = null, $offset = 0, $options = null)
    {
        return $this->sapeClient->return_block_links($n, $offset, $options);
    }
}
