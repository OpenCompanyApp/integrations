<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Row Access Policies Update.
 *
 * Maps to the official BigQuery endpoint PUT /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}.
 */
class GoogleBigQueryRowAccessPoliciesUpdate extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_row_access_policies_update';
    protected const DESCRIPTION = 'Row Access Policies Update

Official BigQuery endpoint: PUT /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}
Updates a row access policy.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `RowAccessPolicy` schema.',
  ),
);
    protected const METHOD = 'PUT';
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
);
    protected const BODY_REQUIRED = true;
}
