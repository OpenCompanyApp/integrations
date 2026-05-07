<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get the signals ingestion URL.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/ingest_url.
 */
class FireHydrantGetSignalsIngestUrl extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_signals_ingest_url';
    protected const DESCRIPTION = 'Get the signals ingestion URL

Official FireHydrant endpoint: GET /v1/signals/ingest_url

Retrieve the url for ingesting signals for your organization';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'Team ID to send signals to directly',
  ),
  'escalation_policy_id' =>
  array (
    'type' => 'string',
    'description' => 'Escalation policy ID to send signals to directly. `team_id` is required if this is provided.',
  ),
  'on_call_schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'On-call schedule ID to send signals to directly. `team_id` is required if this is provided.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'User ID to send signals to directly',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/ingest_url';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'team_id' => 'team_id',
  'escalation_policy_id' => 'escalation_policy_id',
  'on_call_schedule_id' => 'on_call_schedule_id',
  'user_id' => 'user_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
