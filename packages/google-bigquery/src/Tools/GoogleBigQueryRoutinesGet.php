<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Routines Get.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}.
 */
class GoogleBigQueryRoutinesGet extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_routines_get';
    protected const DESCRIPTION = 'Routines Get

Official BigQuery endpoint: GET /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}
Gets the specified routine resource by routine ID.';
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
  'routineId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `routineId`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: readMask.',
  ),
  'readMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `readMask`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'routineId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
  2 => 'routineId',
);
    protected const QUERY_KEYS = array (
  0 => 'readMask',
);
    protected const BODY_REQUIRED = false;
}
