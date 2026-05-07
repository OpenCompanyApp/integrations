<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List permissions
 *
 * Maps to Fastly generated client operation IamPermissionsApi::listPermissions (GET /permissions).
 */
class FastlyIamPermissionsListPermissions extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_permissions_list_permissions';
    protected const DESCRIPTION = 'List permissions

Official Fastly client operation: IamPermissionsApi::listPermissions
Endpoint: GET /permissions

List permissions';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_permissions_list_permissions',
  'class' => 'FastlyIamPermissionsListPermissions',
  'api_class' => 'IamPermissionsApi',
  'method_name' => 'listPermissions',
  'method' => 'GET',
  'path' => '/permissions',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List permissions',
  'description' => 'List permissions',
  'type' => 'read',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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
