<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Patch.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/preview/scim/v2/ServicePrincipals/{id}.
 */
class DatabricksIamPatch5 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_patch_5';
    protected const DESCRIPTION = 'Iam Patch

Official Databricks SDK endpoint: PATCH /api/2.0/preview/scim/v2/ServicePrincipals/{id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/preview/scim/v2/ServicePrincipals/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
}
