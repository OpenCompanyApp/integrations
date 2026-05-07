<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Projects Locations Reasoning Engines Sessions Append Event.
 *
 * Maps to the official Vertex AI endpoint POST /v1/{+name}:appendEvent.
 */
class GoogleVertexAiProjectsLocationsReasoningEnginesSessionsAppendEvent extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_projects_locations_reasoning_engines_sessions_append_event';
    protected const DESCRIPTION = 'Projects Locations Reasoning Engines Sessions Append Event

Official Vertex AI endpoint: POST /v1/{+name}:appendEvent
Appends an event to a given session.';
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
    'description' => 'JSON request body matching the official Vertex AI `GoogleCloudAiplatformV1SessionEvent` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:appendEvent';
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
