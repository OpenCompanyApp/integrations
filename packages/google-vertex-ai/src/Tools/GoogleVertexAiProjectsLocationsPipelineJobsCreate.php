<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Pipeline Jobs Create.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/pipelineJobs.
 */
class GoogleVertexAiProjectsLocationsPipelineJobsCreate extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_pipeline_jobs_create';
    protected const DESCRIPTION = 'Projects Locations Pipeline Jobs Create

Official Vertex AI endpoint: POST /v1/{+parent}/pipelineJobs
Creates a PipelineJob. A PipelineJob will run immediately when created.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: pipelineJobId.',
  ),
  'pipelineJobId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pipelineJobId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1PipelineJob` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/pipelineJobs';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pipelineJobId',
);
    protected const BODY_REQUIRED = true;
}
