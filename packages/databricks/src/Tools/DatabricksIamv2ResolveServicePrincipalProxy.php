<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iamv2 Resolve Service Principal Proxy.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/identity/servicePrincipals/resolveByExternalId.
 */
class DatabricksIamv2ResolveServicePrincipalProxy extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iamv2_resolve_service_principal_proxy';
    protected const DESCRIPTION = 'Iamv2 Resolve Service Principal Proxy

Official Databricks SDK endpoint: POST /api/2.0/identity/servicePrincipals/resolveByExternalId

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
    protected const PATH = '/api/2.0/identity/servicePrincipals/resolveByExternalId';
    protected const PATH_PARAMS = array (
);
}
