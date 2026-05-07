<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List notification policies.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/notification_policy_items.
 */
class FireHydrantListNotificationPolicySettings extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_notification_policy_settings';
    protected const DESCRIPTION = 'List notification policies

Official FireHydrant endpoint: GET /v1/signals/notification_policy_items

List all Signals notification policies.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/v1/signals/notification_policy_items';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
