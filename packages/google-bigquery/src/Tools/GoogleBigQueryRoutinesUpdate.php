<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Routines Update.
 *
 * Maps to the official BigQuery endpoint PUT /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}.
 */
class GoogleBigQueryRoutinesUpdate extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_routines_update';
    protected const DESCRIPTION = 'Routines Update

Official BigQuery endpoint: PUT /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}
Updates information in an existing routine. The update method replaces the entire Routine resource.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `Routine` schema.',
  ),
);
    protected const METHOD = 'PUT';
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
);
    protected const BODY_REQUIRED = true;
}
