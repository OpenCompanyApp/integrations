<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a notification policy.
 *
 * Maps to the official FireHydrant endpoint delete /v1/signals/notification_policy_items/{id}.
 */
class FireHydrantDeleteNotificationPolicy extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_notification_policy';
    protected const DESCRIPTION = 'Delete a notification policy

Official FireHydrant endpoint: DELETE /v1/signals/notification_policy_items/{id}

Delete a Signals notification policy by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
