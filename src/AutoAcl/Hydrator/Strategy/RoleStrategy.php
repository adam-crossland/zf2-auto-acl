<?php
namespace AutoAcl\Hydrator\Strategy;

use AutoAcl\Service\RoleServiceInterface;
use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;
use AutoAcl\Model\RoleInterface;

class RoleStrategy extends DefaultStrategy
{
	/** @var RoleServiceInterface */
	protected $roleService;

	public function __construct(
        RoleServiceInterface $roleServiceInterface
	){
		$this->roleService = $roleServiceInterface;
	}

	/**
	 * @param RoleInterface $value
	 * @return int|mixed
	 */
	public function extract($value)
	{
		if(is_object($value)){
			return $value->getRoleId();
		}
		return $value;
	}

	public function hydrate($value)
	{
		return $this->roleService->load($value);
	}
}