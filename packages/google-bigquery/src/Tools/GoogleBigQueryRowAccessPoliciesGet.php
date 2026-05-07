<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Row Access Policies Get.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}.
 */
class GoogleBigQueryRowAccessPoliciesGet extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_row_access_policies_get';
    protected const DESCRIPTION = 'Row Access Policies Get

Official BigQuery endpoint: GET /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}/rowAccessPolicies/{+policyId}
Gets the specified row access policy by policy ID.';
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
);
    protected const METHOD = 'GET';
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
    protected const BODY_REQUIRED = false;
}
