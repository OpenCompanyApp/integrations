<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Tuning Jobs Rebase Tuned Model.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+parent}/tuningJobs:rebaseTunedModel.
 */
class GoogleVertexAiProjectsLocationsTuningJobsRebaseTunedModel extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_tuning_jobs_rebase_tuned_model';
    protected const DESCRIPTION = 'Projects Locations Tuning Jobs Rebase Tuned Model

Official Vertex AI endpoint: POST /v1/{+parent}/tuningJobs:rebaseTunedModel
Rebase a tuned model. A rebase operation takes a model that was previously tuned on a base model version, and retunes it on a new base model version. The rebase operation creates a new tuning job and a new tuned model.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1RebaseTunedModelRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/tuningJobs:rebaseTunedModel';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
