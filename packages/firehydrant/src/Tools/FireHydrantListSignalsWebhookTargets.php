<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List webhook targets.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/webhook_targets.
 */
class FireHydrantListSignalsWebhookTargets extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_signals_webhook_targets';
    protected const DESCRIPTION = 'List webhook targets

Official FireHydrant endpoint: GET /v1/signals/webhook_targets

List all Signals webhook targets.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query string for searching through the list of webhook targets.',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/webhook_targets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
