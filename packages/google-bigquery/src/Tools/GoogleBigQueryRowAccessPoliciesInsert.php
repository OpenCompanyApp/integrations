<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Row Access Policies Insert.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies.
 */
class GoogleBigQueryRowAccessPoliciesInsert extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_row_access_policies_insert';
    protected const DESCRIPTION = 'Row Access Policies Insert

Official BigQuery endpoint: POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies
Creates a row access policy.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `RowAccessPolicy` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'tableId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'tableId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
