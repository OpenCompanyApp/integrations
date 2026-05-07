<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Compute Change Owner.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/clusters/change-owner.
 */
class DatabricksComputeChangeOwner extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_compute_change_owner';
    protected const DESCRIPTION = 'Compute Change Owner

Official Databricks SDK endpoint: POST /api/2.1/clusters/change-owner

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
    protected const PATH = '/api/2.1/clusters/change-owner';
    protected const PATH_PARAMS = array (
);
}
