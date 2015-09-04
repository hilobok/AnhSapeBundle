<?php

namespace Anh\SapeBundle\Twig;

use Anh\SapeBundle\Sape\SapeClient;

class SapeExtension extends \Twig_Extension
{
    /**
     * @var SapeClient
     */
    private $sapeClient;

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
            new \Twig_SimpleFunction('sape_return_links', array($this, 'returnLinks'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('sape_return_block_links', array($this, 'returnBlockLinks'), array('is_safe' => array('html'))),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'anh_sape';
    }

    /**
     * @param null $n
     * @param int $offset
     * @param null $options
     * @return mixed
     */
    public function returnLinks($n = null, $offset = 0, $options = null)
    {
        return $this->sapeClient->return_links($n, $offset, $options);
    }

    /**
     * @param null $n
     * @param int $offset
     * @param null $options
     * @return mixed
     */
    public function returnBlockLinks($n = null, $offset = 0, $options = null)
    {
        return $this->sapeClient->return_block_links($n, $offset, $options);
    }
}
