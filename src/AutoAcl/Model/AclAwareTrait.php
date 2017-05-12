<?php
namespace AutoAcl\Model;

use Zend\Permissions\Acl\AclInterface;

trait AclAwareTrait
{
    protected $acl;

    /**
     * @param AclInterface $acl
     * @return $this
     */
    public function setAcl(AclInterface $acl)
    {
        $this->acl = $acl;
        return $this;
    }

    /**
     * @return AclInterface
     */
    public function getAcl()
    {
        return $this->acl;
    }
}