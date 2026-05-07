<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List service groups
 *
 * Maps to Fastly generated client operation IamServiceGroupsApi::listServiceGroups (GET /service-groups).
 */
class FastlyIamServiceGroupsListServiceGroups extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_service_groups_list_service_groups';
    protected const DESCRIPTION = 'List service groups

Official Fastly client operation: IamServiceGroupsApi::listServiceGroups
Endpoint: GET /service-groups

List service groups';
    protected const PARAMETERS = array (
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
  'slug' => 'fastly_iam_service_groups_list_service_groups',
  'class' => 'FastlyIamServiceGroupsListServiceGroups',
  'api_class' => 'IamServiceGroupsApi',
  'method_name' => 'listServiceGroups',
  'method' => 'GET',
  'path' => '/service-groups',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List service groups',
  'description' => 'List service groups',
  'type' => 'read',
  'parameters' =>
  array (
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
