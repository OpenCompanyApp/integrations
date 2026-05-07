<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Remove services from a service group
 *
 * Maps to Fastly generated client operation IamServiceGroupsApi::removeServiceGroupServices (DELETE /service-groups/{service_group_id}/services).
 */
class FastlyIamServiceGroupsRemoveServiceGroupServices extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_service_groups_remove_service_group_services';
    protected const DESCRIPTION = 'Remove services from a service group

Official Fastly client operation: IamServiceGroupsApi::removeServiceGroupServices
Endpoint: DELETE /service-groups/{service_group_id}/services

Remove services from a service group';
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
  'slug' => 'fastly_iam_service_groups_remove_service_group_services',
  'class' => 'FastlyIamServiceGroupsRemoveServiceGroupServices',
  'api_class' => 'IamServiceGroupsApi',
  'method_name' => 'removeServiceGroupServices',
  'method' => 'DELETE',
  'path' => '/service-groups/{service_group_id}/services',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Remove services from a service group',
  'description' => 'Remove services from a service group',
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
