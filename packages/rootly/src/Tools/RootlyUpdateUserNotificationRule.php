<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an user notification rule.
 *
 * Maps to the official Rootly endpoint put /v1/notification_rules/{id}.
 */
class RootlyUpdateUserNotificationRule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_user_notification_rule';
    protected const DESCRIPTION = 'Update an user notification rule

Official Rootly endpoint: PUT /v1/notification_rules/{id}

Update a specific user notification rule by id';
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
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/notification_rules/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
