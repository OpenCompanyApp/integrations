<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Unsubscribe from status page notifications.
 *
 * Maps to the official FireHydrant endpoint delete /v1/nunc/subscriptions/{unsubscribe_token}.
 */
class FireHydrantDeleteNuncSubscription extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_nunc_subscription';
    protected const DESCRIPTION = 'Unsubscribe from status page notifications

Official FireHydrant endpoint: DELETE /v1/nunc/subscriptions/{unsubscribe_token}

Unsubscribe from status page updates';
    protected const PARAMETERS = array (
  'unsubscribe_token' =>
  array (
    'type' => 'string',
    'description' => 'unsubscribe_token parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/nunc/subscriptions/{unsubscribe_token}';
    protected const PATH_PARAMS = array (
  'unsubscribe_token' => 'unsubscribe_token',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
