<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List conditions
 *
 * Maps to Fastly generated client operation ConditionApi::listConditions (GET /service/{service_id}/version/{version_id}/condition).
 */
class FastlyConditionListConditions extends AbstractFastlyTool
{
    protected const NAME = 'fastly_condition_list_conditions';
    protected const DESCRIPTION = 'List conditions

Official Fastly client operation: ConditionApi::listConditions
Endpoint: GET /service/{service_id}/version/{version_id}/condition

List conditions';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_condition_list_conditions',
  'class' => 'FastlyConditionListConditions',
  'api_class' => 'ConditionApi',
  'method_name' => 'listConditions',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/condition',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List conditions',
  'description' => 'List conditions',
  'type' => 'read',
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
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
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
