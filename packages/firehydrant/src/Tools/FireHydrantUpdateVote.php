<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update votes.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incidents/{incident_id}/events/{event_id}/votes.
 */
class FireHydrantUpdateVote extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_vote';
    protected const DESCRIPTION = 'Update votes

Official FireHydrant endpoint: PATCH /v1/incidents/{incident_id}/events/{event_id}/votes

Upvote or downvote an object';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/incidents/{incident_id}/events/{event_id}/votes';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'event_id' => 'event_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
