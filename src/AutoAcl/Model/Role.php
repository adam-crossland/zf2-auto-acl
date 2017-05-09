<?php
namespace AutoAcl\Model;


use Zend\Permissions\Acl\Role\GenericRole;

class Role extends GenericRole implements RoleInterface
{
    protected $name;

    protected $description;

    public function __construct(
        $roleID,
        $name = '',
        $description = ''
    ){
        parent::__construct($roleID);
        $this->name = $name;
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}