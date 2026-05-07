<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Studies Trials Check Trial Early Stopping State.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+trialName}:checkTrialEarlyStoppingState.
 */
class GoogleVertexAiProjectsLocationsStudiesTrialsCheckTrialEarlyStoppingState extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_studies_trials_check_trial_early_stopping_state';
    protected const DESCRIPTION = 'Projects Locations Studies Trials Check Trial Early Stopping State

Official Vertex AI endpoint: POST /v1/{+trialName}:checkTrialEarlyStoppingState
Checks whether a Trial should stop or not. Returns a long-running operation. When the operation is successful, it will contain a CheckTrialEarlyStoppingStateResponse.';
    protected const PARAMETERS = array (
  'trialName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `trialName`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1CheckTrialEarlyStoppingStateRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+trialName}:checkTrialEarlyStoppingState';
    protected const PATH_PARAMS = array (
  0 => 'trialName',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'trialName',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
