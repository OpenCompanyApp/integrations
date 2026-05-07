<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an user notification rule.
 *
 * Maps to the official Rootly endpoint delete /v1/notification_rules/{id}.
 */
class RootlyDeleteUserNotificationRule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_user_notification_rule';
    protected const DESCRIPTION = 'Delete an user notification rule

Official Rootly endpoint: DELETE /v1/notification_rules/{id}

Delete a specific user notification rule by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
