<?php
namespace SiteMaster\Core\Registry;

use SiteMaster\Core\Config;
use SiteMaster\Core\ViewableInterface;

class Search implements ViewableInterface
{
    public $sites = array();
    public $result;
    
    function __construct($options = array())
    {
        if (isset($options['query'])) {
            $this->result = $this->handleQuery($options['query']);
        }
    }

    public function getPageTitle()
    {
        return "Registry";
    }

    public function getURL()
    {
        return Config::get('URL') . 'registry/';
    }
    
    protected function handleQuery($query_string)
    {
        $query = new Query();
        
        return $query->query($query_string);
    }
}