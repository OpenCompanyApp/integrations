<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get votes.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/events/{event_id}/votes/status.
 */
class FireHydrantGetVoteStatus extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_vote_status';
    protected const DESCRIPTION = 'Get votes

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/events/{event_id}/votes/status

Get an object\'s current vote counts';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'event_id' =>
  array (
    'type' => 'string',
    'description' => 'event_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/events/{event_id}/votes/status';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'event_id' => 'event_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
