<?php
namespace AutoAcl\Service;

use AutoAcl\Model\RoleInterface;

interface RoleServiceInterface
{
    /**
     * @return array []RoleInterface
     */
    public function getAll();

    /**
     * @param $roleId string
     * @return RoleInterface|null
     */
    public function load($roleId);

    /**
     * @return []
     */
    public function getRolesOptionArray();
}