<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List services to a service group
 *
 * Maps to Fastly generated client operation IamServiceGroupsApi::listServiceGroupServices (GET /service-groups/{service_group_id}/services).
 */
class FastlyIamServiceGroupsListServiceGroupServices extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_service_groups_list_service_group_services';
    protected const DESCRIPTION = 'List services to a service group

Official Fastly client operation: IamServiceGroupsApi::listServiceGroupServices
Endpoint: GET /service-groups/{service_group_id}/services

List services to a service group';
    protected const PARAMETERS = array (
  'service_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_group_id`.',
  ),
  'per_page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `per_page`.',
  ),
  'page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_service_groups_list_service_group_services',
  'class' => 'FastlyIamServiceGroupsListServiceGroupServices',
  'api_class' => 'IamServiceGroupsApi',
  'method_name' => 'listServiceGroupServices',
  'method' => 'GET',
  'path' => '/service-groups/{service_group_id}/services',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List services to a service group',
  'description' => 'List services to a service group',
  'type' => 'read',
  'parameters' =>
  array (
    'service_group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_group_id`.',
    ),
    'per_page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `per_page`.',
    ),
    'page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page`.',
    ),
  ),
  'path_params' =>
  array (
    'service_group_id' => 'service_group_id',
  ),
  'query_params' =>
  array (
    'per_page' => 'per_page',
    'page' => 'page',
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
