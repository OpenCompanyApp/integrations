<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a webhook target.
 *
 * Maps to the official FireHydrant endpoint patch /v1/signals/webhook_targets/{id}.
 */
class FireHydrantUpdateSignalsWebhookTarget extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_signals_webhook_target';
    protected const DESCRIPTION = 'Update a webhook target

Official FireHydrant endpoint: PATCH /v1/signals/webhook_targets/{id}

Update a Signals webhook target by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
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
    protected const PATH = '/v1/signals/webhook_targets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
