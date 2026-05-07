<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List notification settings for a user.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/users/{user_id}/notification_settings.
 */
class FireHydrantListUserNotificationSettingsByUserId extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_user_notification_settings_by_user_id';
    protected const DESCRIPTION = 'List notification settings for a user

Official FireHydrant endpoint: GET /v1/signals/users/{user_id}/notification_settings

List all Signals notification settings for a specific user. Requires an API key with PII access enabled.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
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
  'notification_priority' =>
  array (
    'type' => 'string',
    'description' => 'The level of priority for the notification setting.',
    'enum' =>
    array (
      0 => 'HIGH',
      1 => 'MEDIUM',
      2 => 'LOW',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/users/{user_id}/notification_settings';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'notification_priority' => 'notification_priority',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
