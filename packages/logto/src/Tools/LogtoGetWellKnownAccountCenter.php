<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get default account center.
 *
 * Maps to GET /api/.well-known/account-center in the official Logto OpenAPI source.
 */
class LogtoGetWellKnownAccountCenter extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_well_known_account_center',
  'class' => 'LogtoGetWellKnownAccountCenter',
  'method' => 'GET',
  'path' => '/api/.well-known/account-center',
  'operation_id' => 'GetWellKnownAccountCenter',
  'summary' => 'Get default account center',
  'description' => 'Get the default account center configuration.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
