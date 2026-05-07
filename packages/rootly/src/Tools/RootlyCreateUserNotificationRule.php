<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an user notification rule.
 *
 * Maps to the official Rootly endpoint post /v1/users/{user_id}/notification_rules.
 */
class RootlyCreateUserNotificationRule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_user_notification_rule';
    protected const DESCRIPTION = 'Creates an user notification rule

Official Rootly endpoint: POST /v1/users/{user_id}/notification_rules

Creates a new user notification rule from provided data';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/users/{user_id}/notification_rules';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
