<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Tracing Project Prebuilt Dashboard.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/sessions/{session_id}/dashboard.
 */
class LangSmithGetTracingProjectPrebuiltDashboard extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_tracing_project_prebuilt_dashboard';
    protected const DESCRIPTION = 'Get Tracing Project Prebuilt Dashboard

Official endpoint: POST /api/v1/sessions/{session_id}/dashboard
Get a prebuilt dashboard for a tracing project.';
    protected const PARAMETERS = array (
  'session_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `session_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/sessions/{session_id}/dashboard';
    protected const PATH_PARAMS = array (
  0 => 'session_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
