<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Get.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/preview/scim/v2/Users/{id}.
 */
class DatabricksIamGet7 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_get_7';
    protected const DESCRIPTION = 'Iam Get

Official Databricks SDK endpoint: GET /api/2.0/preview/scim/v2/Users/{id}

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/preview/scim/v2/Users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
}
