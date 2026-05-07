<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Notebook Execution Jobs List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+parent}/notebookExecutionJobs.
 */
class GoogleVertexAiProjectsLocationsNotebookExecutionJobsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_notebook_execution_jobs_list';
    protected const DESCRIPTION = 'Projects Locations Notebook Execution Jobs List

Official Vertex AI endpoint: GET /v1/{+parent}/notebookExecutionJobs
Lists NotebookExecutionJobs in a Location.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: filter, pageToken, orderBy, view, pageSize.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
  ),
  'view' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `view`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+parent}/notebookExecutionJobs';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'pageToken',
  2 => 'orderBy',
  3 => 'view',
  4 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
