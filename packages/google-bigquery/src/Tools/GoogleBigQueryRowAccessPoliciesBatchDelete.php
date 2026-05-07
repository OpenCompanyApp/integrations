<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Row Access Policies Batch Delete.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies:batchDelete.
 */
class GoogleBigQueryRowAccessPoliciesBatchDelete extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_row_access_policies_batch_delete';
    protected const DESCRIPTION = 'Row Access Policies Batch Delete

Official BigQuery endpoint: POST /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies:batchDelete
Deletes provided row access policies.';
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
    'description' => 'JSON request body matching the official BigQuery `BatchDeleteRowAccessPoliciesRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies:batchDelete';
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
