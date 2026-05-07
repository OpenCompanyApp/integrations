<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * List SSO connectors.
 *
 * Maps to GET /api/sso-connectors in the official Logto OpenAPI source.
 */
class LogtoListSsoConnectors extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_sso_connectors',
  'class' => 'LogtoListSsoConnectors',
  'method' => 'GET',
  'path' => '/api/sso-connectors',
  'operation_id' => 'ListSsoConnectors',
  'summary' => 'List SSO connectors',
  'description' => 'Get SSO connectors with pagination. In addition to the raw SSO connector data, a copy of fetched or parsed IdP configs and a copy of connector provider\'s data will be attached.',
  'parameters' =>
  array (
    'page' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Page number (starts from 1).',
    ),
    'page_size' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Entries per page.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'page' => 'page',
    'page_size' => 'page_size',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
