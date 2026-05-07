<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a condition
 *
 * Maps to Fastly generated client operation ConditionApi::deleteCondition (DELETE /service/{service_id}/version/{version_id}/condition/{condition_name}).
 */
class FastlyConditionDeleteCondition extends AbstractFastlyTool
{
    protected const NAME = 'fastly_condition_delete_condition';
    protected const DESCRIPTION = 'Delete a condition

Official Fastly client operation: ConditionApi::deleteCondition
Endpoint: DELETE /service/{service_id}/version/{version_id}/condition/{condition_name}

Delete a condition';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_condition_delete_condition',
  'class' => 'FastlyConditionDeleteCondition',
  'api_class' => 'ConditionApi',
  'method_name' => 'deleteCondition',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/condition/{condition_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a condition',
  'description' => 'Delete a condition',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
