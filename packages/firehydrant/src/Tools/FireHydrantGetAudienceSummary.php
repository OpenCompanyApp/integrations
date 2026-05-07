<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get latest summary.
 *
 * Maps to the official FireHydrant endpoint get /v1/audiences/{audience_id}/summaries/{incident_id}.
 */
class FireHydrantGetAudienceSummary extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_audience_summary';
    protected const DESCRIPTION = 'Get latest summary

Official FireHydrant endpoint: GET /v1/audiences/{audience_id}/summaries/{incident_id}

Get the latest audience-specific summary for an incident';
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
);
    protected const METHOD = 'get';
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
