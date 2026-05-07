<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a service group
 *
 * Maps to Fastly generated client operation IamServiceGroupsApi::updateAServiceGroup (PATCH /service-groups/{service_group_id}).
 */
class FastlyIamServiceGroupsUpdateAserviceGroup extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_service_groups_update_aservice_group';
    protected const DESCRIPTION = 'Update a service group

Official Fastly client operation: IamServiceGroupsApi::updateAServiceGroup
Endpoint: PATCH /service-groups/{service_group_id}

Update a service group';
    protected const PARAMETERS = array (
  'service_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_group_id`.',
  ),
  'request_body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_service_groups_update_aservice_group',
  'class' => 'FastlyIamServiceGroupsUpdateAserviceGroup',
  'api_class' => 'IamServiceGroupsApi',
  'method_name' => 'updateAServiceGroup',
  'method' => 'PATCH',
  'path' => '/service-groups/{service_group_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a service group',
  'description' => 'Update a service group',
  'type' => 'write',
  'parameters' =>
  array (
    'service_group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_group_id`.',
    ),
    'request_body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
  ),
  'path_params' =>
  array (
    'service_group_id' => 'service_group_id',
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
  'body_param' => 'request_body',
  'body_required' => false,
);
}
