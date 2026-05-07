<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get the current user's vote status for an AI-generated incident summary.
 *
 * Maps to the official FireHydrant endpoint get /v1/ai/summarize_incident/{incident_id}/{generated_summary_id}/voted.
 */
class FireHydrantGetAiIncidentSummaryVoteStatus extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_ai_incident_summary_vote_status';
    protected const DESCRIPTION = 'Get the current user\'s vote status for an AI-generated incident summary

Official FireHydrant endpoint: GET /v1/ai/summarize_incident/{incident_id}/{generated_summary_id}/voted

Get the current user\'s vote status for an AI-generated incident summary';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'generated_summary_id' =>
  array (
    'type' => 'string',
    'description' => 'generated_summary_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ai/summarize_incident/{incident_id}/{generated_summary_id}/voted';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'generated_summary_id' => 'generated_summary_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
