<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a webhook target.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/webhook_targets/{id}.
 */
class FireHydrantGetSignalsWebhookTarget extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_signals_webhook_target';
    protected const DESCRIPTION = 'Get a webhook target

Official FireHydrant endpoint: GET /v1/signals/webhook_targets/{id}

Get a Signals webhook target by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/webhook_targets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
