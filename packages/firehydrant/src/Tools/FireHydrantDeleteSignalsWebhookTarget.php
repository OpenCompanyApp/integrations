<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a webhook target.
 *
 * Maps to the official FireHydrant endpoint delete /v1/signals/webhook_targets/{id}.
 */
class FireHydrantDeleteSignalsWebhookTarget extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_signals_webhook_target';
    protected const DESCRIPTION = 'Delete a webhook target

Official FireHydrant endpoint: DELETE /v1/signals/webhook_targets/{id}

Delete a Signals webhook target by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
