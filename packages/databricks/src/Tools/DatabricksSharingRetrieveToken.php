<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sharing Retrieve Token.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/unity-catalog/public/data_sharing_activation/{activation_url}.
 */
class DatabricksSharingRetrieveToken extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sharing_retrieve_token';
    protected const DESCRIPTION = 'Sharing Retrieve Token

Official Databricks SDK endpoint: GET /api/2.1/unity-catalog/public/data_sharing_activation/{activation_url}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'activation_url' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `activation_url` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/public/data_sharing_activation/{activation_url}';
    protected const PATH_PARAMS = array (
  'activation_url' => 'activation_url',
);
}
