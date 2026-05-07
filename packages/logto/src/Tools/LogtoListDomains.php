<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get domains.
 *
 * Maps to GET /api/domains in the official Logto OpenAPI source.
 */
class LogtoListDomains extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_domains',
  'class' => 'LogtoListDomains',
  'method' => 'GET',
  'path' => '/api/domains',
  'operation_id' => 'ListDomains',
  'summary' => 'Get domains',
  'description' => 'Get all of your custom domains.',
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
