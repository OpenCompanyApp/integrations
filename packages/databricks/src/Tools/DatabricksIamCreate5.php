<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Iam Create.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/preview/scim/v2/ServicePrincipals.
 */
class DatabricksIamCreate5 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_iam_create_5';
    protected const DESCRIPTION = 'Iam Create

Official Databricks SDK endpoint: POST /api/2.0/preview/scim/v2/ServicePrincipals

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
    protected const PATH = '/api/2.0/preview/scim/v2/ServicePrincipals';
    protected const PATH_PARAMS = array (
);
}
