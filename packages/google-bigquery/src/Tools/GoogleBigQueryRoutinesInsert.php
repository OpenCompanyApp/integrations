<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Routines Insert.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/datasets/{+datasetId}/routines.
 */
class GoogleBigQueryRoutinesInsert extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_routines_insert';
    protected const DESCRIPTION = 'Routines Insert

Official BigQuery endpoint: POST /projects/{+projectId}/datasets/{+datasetId}/routines
Creates a new routine in the dataset.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `Routine` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/routines';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
