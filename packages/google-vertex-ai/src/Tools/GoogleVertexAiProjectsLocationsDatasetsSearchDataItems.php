<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Datasets Search Data Items.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+dataset}:searchDataItems.
 */
class GoogleVertexAiProjectsLocationsDatasetsSearchDataItems extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_datasets_search_data_items';
    protected const DESCRIPTION = 'Projects Locations Datasets Search Data Items

Official Vertex AI endpoint: GET /v1/{+dataset}:searchDataItems
Searches DataItems in a Dataset.';
    protected const PARAMETERS = array (
  'dataset' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: savedQuery, fieldMask, pageToken, annotationsFilter, annotationsLimit, dataLabelingJob, orderByDataItem, orderByAnnotation.orderBy, orderBy, pageSize, dataItemFilter, annotationFilters, orderByAnnotation.savedQuery.',
  ),
  'savedQuery' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `savedQuery`.',
  ),
  'fieldMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `fieldMask`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'annotationsFilter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `annotationsFilter`.',
  ),
  'annotationsLimit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `annotationsLimit`.',
  ),
  'dataLabelingJob' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dataLabelingJob`.',
  ),
  'orderByDataItem' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderByDataItem`.',
  ),
  'orderByAnnotation.orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderByAnnotation.orderBy`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'dataItemFilter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `dataItemFilter`.',
  ),
  'annotationFilters' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `annotationFilters`.',
  ),
  'orderByAnnotation.savedQuery' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderByAnnotation.savedQuery`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+dataset}:searchDataItems';
    protected const PATH_PARAMS = array (
  0 => 'dataset',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'dataset',
);
    protected const QUERY_KEYS = array (
  0 => 'savedQuery',
  1 => 'fieldMask',
  2 => 'pageToken',
  3 => 'annotationsFilter',
  4 => 'annotationsLimit',
  5 => 'dataLabelingJob',
  6 => 'orderByDataItem',
  7 => 'orderByAnnotation.orderBy',
  8 => 'orderBy',
  9 => 'pageSize',
  10 => 'dataItemFilter',
  11 => 'annotationFilters',
  12 => 'orderByAnnotation.savedQuery',
);
    protected const BODY_REQUIRED = false;
}
