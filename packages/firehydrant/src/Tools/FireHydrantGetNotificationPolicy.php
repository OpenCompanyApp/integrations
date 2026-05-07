<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a notification policy.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/notification_policy_items/{id}.
 */
class FireHydrantGetNotificationPolicy extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_notification_policy';
    protected const DESCRIPTION = 'Get a notification policy

Official FireHydrant endpoint: GET /v1/signals/notification_policy_items/{id}

Get a Signals notification policy by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/notification_policy_items/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
