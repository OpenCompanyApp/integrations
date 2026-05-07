<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Row Access Policies Delete.
 *
 * Maps to the official BigQuery endpoint DELETE /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}.
 */
class GoogleBigQueryRowAccessPoliciesDelete extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_row_access_policies_delete';
    protected const DESCRIPTION = 'Row Access Policies Delete

Official BigQuery endpoint: DELETE /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}
Deletes a row access policy.';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
  'datasetId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `datasetId`.',
  ),
  'tableId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tableId`.',
  ),
  'policyId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `policyId`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: force.',
  ),
  'force' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `force`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'tableId',
  3 => 'policyId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'tableId',
  3 => 'policyId',
);
    protected const QUERY_KEYS = array (
  0 => 'force',
);
    protected const BODY_REQUIRED = false;
}
