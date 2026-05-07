<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Generate summary (async).
 *
 * Maps to the official FireHydrant endpoint post /v1/audiences/{audience_id}/summaries/{incident_id}.
 */
class FireHydrantGenerateAudienceSummary extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_generate_audience_summary';
    protected const DESCRIPTION = 'Generate summary (async)

Official FireHydrant endpoint: POST /v1/audiences/{audience_id}/summaries/{incident_id}

Initiates asynchronous generation of a new audience-specific summary for an incident. This is an async operation that can take up to 60 seconds to complete. The response includes a WebSocket topic name for internal use. After initiating generation, use the GET endpoint to poll for the completed summary.';
    protected const PARAMETERS = array (
  'audience_id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the audience',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the incident to summarize',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/audiences/{audience_id}/summaries/{incident_id}';
    protected const PATH_PARAMS = array (
  'audience_id' => 'audience_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
