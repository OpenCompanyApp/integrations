<?php

namespace OpenCompany\Integrations\GoogleVertexAi\Tools;

/**
 * Reasoning Engines Sandbox Environment Snapshots List.
 *
 * Maps to the official Vertex AI endpoint GET /v1/{+parent}/sandboxEnvironmentSnapshots.
 */
class GoogleVertexAiReasoningEnginesSandboxEnvironmentSnapshotsList extends AbstractGoogleVertexAiTool
{
    protected const NAME = 'google_vertex_ai_reasoning_engines_sandbox_environment_snapshots_list';
    protected const DESCRIPTION = 'Reasoning Engines Sandbox Environment Snapshots List

Official Vertex AI endpoint: GET /v1/{+parent}/sandboxEnvironmentSnapshots
Lists SandboxEnvironmentSnapshots in a given reasoning engine.';
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
    'description' => 'Query string parameters accepted by the official Vertex AI method. Known keys: filter, pageSize, pageToken.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
  'pageSize' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+parent}/sandboxEnvironmentSnapshots';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'filter',
  1 => 'pageSize',
  2 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
