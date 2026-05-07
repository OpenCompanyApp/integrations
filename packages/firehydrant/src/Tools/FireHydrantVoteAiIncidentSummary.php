<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Vote on an AI-generated incident summary.
 *
 * Maps to the official FireHydrant endpoint put /v1/ai/summarize_incident/{incident_id}/{generated_summary_id}/vote.
 */
class FireHydrantVoteAiIncidentSummary extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_vote_ai_incident_summary';
    protected const DESCRIPTION = 'Vote on an AI-generated incident summary

Official FireHydrant endpoint: PUT /v1/ai/summarize_incident/{incident_id}/{generated_summary_id}/vote

Vote on an AI-generated incident summary for the current user';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/ai/summarize_incident/{incident_id}/{generated_summary_id}/vote';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'generated_summary_id' => 'generated_summary_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
