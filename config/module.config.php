<?php
return array(
    'service_manager' => array(
        'abstract_factories' => array(),
        'factories' => array(
			'AutoAcl\Acl' => 'AutoAcl\Factory\Model\AutoAclFactory',
            \AutoAcl\Service\RoleServiceInterface::class => 'AutoAcl\Factory\Service\RoleServiceFactory',
            'AutoAcl\Hydrator\Strategy\RoleStrategy' => 'AutoAcl\Factory\Hydrator\Strategy\RoleStrategyFactory',
        ),
		'invokables' => array(
		),
		'initializers' => array(
            'AutoAcl\Initializer\AclAwareInitializer' => 'AutoAcl\Initializer\AclAwareInitializer'
		),
		'shared' => array(
		),
    ),
	'controllers' => array(
		'factories' => array(
		),
	),
	'router' => array(
		'routes' => array(
		),
	),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
		'strategies' => array(
		),
    ),
	'view_helpers' => array(
		'factories' => array(
		),
	),
	'form_elements' => array(
		'invokables' => array(
		),
	),
	'asset_manager' => array(
		'resolver_configs' => array(
			'paths' => array(
				'AutoAcl' => __DIR__.'/../public',
			),
		),
	),
	'auto-acl' => array(
		'settings' => array(

		),
		'roles' => array(
//			'[ROLE ID]' => array(
//                'name' => '', // A human friendly name
//                'description' => '', // A human friendly description
//                'parents' => array(),
//				'allow' => array(
//					// Permission ID isn't used for anything other then
//					// Identifying specific permission
//					'[PERMISSION ID]' => array(
//						'resource' => 'RESOURCE NAME',
//						//privileges can be null for all
//						// if an empty array is found it will be tread as null
//						'privileges' => array(
//							'[PRIV 1]',
//							'[PRIV 2]',
//						),
//					),
//				),
//				'deny' => array(
//					'[PERMISSION ID]' => array(
//						'resource' => 'RESOURCE NAME',
//						'privileges' => array(
//							'[PRIV 1]',
//							'[PRIV 2]',
//						),
//					),
//				),
//			),
		),
	),
);
