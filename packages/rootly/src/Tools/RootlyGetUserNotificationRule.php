<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an user notification rule.
 *
 * Maps to the official Rootly endpoint get /v1/notification_rules/{id}.
 */
class RootlyGetUserNotificationRule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_user_notification_rule';
    protected const DESCRIPTION = 'Retrieves an user notification rule

Official Rootly endpoint: GET /v1/notification_rules/{id}

Retrieves a specific user notification rule by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/notification_rules/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
