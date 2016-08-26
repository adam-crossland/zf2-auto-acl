<?php
return array(
    'service_manager' => array(
        'abstract_factories' => array(),
        'factories' => array(
        ),
		'invokables' => array(
		),
		'initializers' => array(
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
);
