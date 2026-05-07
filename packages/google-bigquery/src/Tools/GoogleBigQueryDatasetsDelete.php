<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Datasets Delete.
 *
 * Maps to the official BigQuery endpoint DELETE /projects/{+projectId}/datasets/{+datasetId}.
 */
class GoogleBigQueryDatasetsDelete extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_datasets_delete';
    protected const DESCRIPTION = 'Datasets Delete

Official BigQuery endpoint: DELETE /projects/{+projectId}/datasets/{+datasetId}
Deletes the dataset specified by the datasetId value. Before you can delete a dataset, you must delete all its tables, either manually or by specifying deleteContents. Immediately after deletion, you can create another dataset with the same name.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official BigQuery method. Known keys: deleteContents.',
  ),
  'deleteContents' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `deleteContents`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/projects/{+projectId}/datasets/{+datasetId}';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
  1 => 'datasetId',
);
    protected const QUERY_KEYS = array (
  0 => 'deleteContents',
);
    protected const BODY_REQUIRED = false;
}
