<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a condition
 *
 * Maps to Fastly generated client operation ConditionApi::updateCondition (PUT /service/{service_id}/version/{version_id}/condition/{condition_name}).
 */
class FastlyConditionUpdateCondition extends AbstractFastlyTool
{
    protected const NAME = 'fastly_condition_update_condition';
    protected const DESCRIPTION = 'Update a condition

Official Fastly client operation: ConditionApi::updateCondition
Endpoint: PUT /service/{service_id}/version/{version_id}/condition/{condition_name}

Update a condition';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `version_id`.',
  ),
  'condition_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `condition_name`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'priority' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `priority`.',
  ),
  'statement' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `statement`.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `version`.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `type`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_condition_update_condition',
  'class' => 'FastlyConditionUpdateCondition',
  'api_class' => 'ConditionApi',
  'method_name' => 'updateCondition',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/condition/{condition_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a condition',
  'description' => 'Update a condition',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `version_id`.',
    ),
    'condition_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `condition_name`.',
    ),
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'priority' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `priority`.',
    ),
    'statement' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `statement`.',
    ),
    'version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `version`.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `type`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'condition_name' => 'condition_name',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
    'comment' => 'comment',
    'name' => 'name',
    'priority' => 'priority',
    'statement' => 'statement',
    'service_id' => 'service_id',
    'version' => 'version',
    'type' => 'type',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
