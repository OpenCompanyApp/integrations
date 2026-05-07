<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Routines Delete.
 *
 * Maps to the official BigQuery endpoint DELETE /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}.
 */
class GoogleBigQueryRoutinesDelete extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_routines_delete';
    protected const DESCRIPTION = 'Routines Delete

Official BigQuery endpoint: DELETE /projects/{+projectId}/datasets/{+datasetId}/routines/{+routineId}
Deletes the routine specified by routineId from the dataset.';
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
);
    protected const METHOD = 'DELETE';
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
    protected const BODY_REQUIRED = false;
}
