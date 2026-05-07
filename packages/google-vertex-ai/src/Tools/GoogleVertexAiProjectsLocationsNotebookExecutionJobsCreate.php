<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Notebook Execution Jobs Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/notebookExecutionJobs.
 */
class GoogleVertexAiProjectsLocationsNotebookExecutionJobsCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_notebook_execution_jobs_create';
    protected const DESCRIPTION = 'Projects Locations Notebook Execution Jobs Create

Official Vertex AI endpoint: POST /v1/{+parent}/notebookExecutionJobs
Creates a NotebookExecutionJob.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: notebookExecutionJobId.',
  ),
  'notebookExecutionJobId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `notebookExecutionJobId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1NotebookExecutionJob` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/notebookExecutionJobs';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'notebookExecutionJobId',
);
    protected const BODY_REQUIRED = true;
}
