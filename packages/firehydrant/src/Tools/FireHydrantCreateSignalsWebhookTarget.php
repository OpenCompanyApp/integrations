<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a webhook target.
 *
 * Maps to the official FireHydrant endpoint post /v1/signals/webhook_targets.
 */
class FireHydrantCreateSignalsWebhookTarget extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_signals_webhook_target';
    protected const DESCRIPTION = 'Create a webhook target

Official FireHydrant endpoint: POST /v1/signals/webhook_targets

Create a Signals webhook target.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/signals/webhook_targets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
