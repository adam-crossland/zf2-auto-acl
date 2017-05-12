<?php
namespace AutoAcl\Model;

use Zend\Permissions\Acl\AclInterface;

interface AclAwareInterface
{
    /**
     * @param AclInterface $aclInterface
     * @return $this
     */
    public function setAcl(AclInterface $aclInterface);

    /**
     * @return AclInterface|null
     */
    public function getAcl();
}