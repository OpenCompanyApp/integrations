<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a notification policy.
 *
 * Maps to the official FireHydrant endpoint post /v1/signals/notification_policy_items.
 */
class FireHydrantCreateNotificationPolicy extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_notification_policy';
    protected const DESCRIPTION = 'Create a notification policy

Official FireHydrant endpoint: POST /v1/signals/notification_policy_items

Create a Signals notification policy.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/signals/notification_policy_items';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
