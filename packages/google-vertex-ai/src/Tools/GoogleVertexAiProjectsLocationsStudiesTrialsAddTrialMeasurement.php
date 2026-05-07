<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Studies Trials Add Trial Measurement.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+trialName}:addTrialMeasurement.
 */
class GoogleVertexAiProjectsLocationsStudiesTrialsAddTrialMeasurement extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_studies_trials_add_trial_measurement';
    protected const DESCRIPTION = 'Projects Locations Studies Trials Add Trial Measurement

Official Vertex AI endpoint: POST /v1/{+trialName}:addTrialMeasurement
Adds a measurement of the objective metrics to a Trial. This measurement is assumed to have been taken before the Trial is complete.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1AddTrialMeasurementRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+trialName}:addTrialMeasurement';
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
