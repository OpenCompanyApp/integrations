<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iamv2 Resolve Group.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/identity/accounts/{account_id}/groups/resolveByExternalId.
 */
class DatabricksIamv2ResolveGroup extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iamv2_resolve_group';
    protected const DESCRIPTION = 'Iamv2 Resolve Group

Official Databricks SDK endpoint: POST /api/2.0/identity/accounts/{account_id}/groups/resolveByExternalId

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `account_id` from the Databricks SDK endpoint.',
  ),
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
    protected const PATH = '/api/2.0/identity/accounts/{account_id}/groups/resolveByExternalId';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
}
