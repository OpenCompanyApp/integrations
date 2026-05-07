<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Schedules Pause.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:pause.
 */
class GoogleVertexAiProjectsLocationsSchedulesPause extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_schedules_pause';
    protected const DESCRIPTION = 'Projects Locations Schedules Pause

Official Vertex AI endpoint: POST /v1/{+name}:pause
Pauses a Schedule. Will mark Schedule.state to \'PAUSED\'. If the schedule is paused, no new runs will be created. Already created runs will NOT be paused or canceled.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Vertex AI resource names such as `projects/example/locations/us-central1/models/model-id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1PauseScheduleRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:pause';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
