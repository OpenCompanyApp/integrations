<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Tables Patch.
 *
 * Maps to the official BigQuery endpoint PATCH /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}.
 */
class GoogleBigQueryTablesPatch extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_tables_patch';
    protected const DESCRIPTION = 'Tables Patch

Official BigQuery endpoint: PATCH /projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}
Updates information in an existing table. The update method replaces the entire table resource, whereas the patch method only replaces fields that are provided in the submitted table resource. This method supports RFC5789 patch semantics.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: autodetect_schema.',
  ),
  'autodetect_schema' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `autodetect_schema`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `Table` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/tables/{+tableId}';
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
  0 => 'autodetect_schema',
);
    protected const BODY_REQUIRED = true;
}
