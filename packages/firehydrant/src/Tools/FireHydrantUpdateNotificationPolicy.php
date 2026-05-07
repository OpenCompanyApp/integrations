<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a notification policy.
 *
 * Maps to the official FireHydrant endpoint patch /v1/signals/notification_policy_items/{id}.
 */
class FireHydrantUpdateNotificationPolicy extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_notification_policy';
    protected const DESCRIPTION = 'Update a notification policy

Official FireHydrant endpoint: PATCH /v1/signals/notification_policy_items/{id}

Update a Signals notification policy by ID';
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
  ),
);
    protected const METHOD = 'patch';
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
