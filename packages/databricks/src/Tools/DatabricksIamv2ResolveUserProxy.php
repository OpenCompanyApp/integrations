<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iamv2 Resolve User Proxy.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/identity/users/resolveByExternalId.
 */
class DatabricksIamv2ResolveUserProxy extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iamv2_resolve_user_proxy';
    protected const DESCRIPTION = 'Iamv2 Resolve User Proxy

Official Databricks SDK endpoint: POST /api/2.0/identity/users/resolveByExternalId

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Optional query string parameters matching the Databricks REST API request fields.',
  ),
  'headers' =>
  array (
    'type' => 'object',
    'description' => 'Optional additional request headers for advanced Databricks endpoints.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional JSON request body matching the Databricks REST API request fields.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/identity/users/resolveByExternalId';
    protected const PATH_PARAMS = array (
);
}
