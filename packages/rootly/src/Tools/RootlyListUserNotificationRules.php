<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List user notification rules.
 *
 * Maps to the official Rootly endpoint get /v1/users/{user_id}/notification_rules.
 */
class RootlyListUserNotificationRules extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_user_notification_rules';
    protected const DESCRIPTION = 'List user notification rules

Official Rootly endpoint: GET /v1/users/{user_id}/notification_rules

List user notification rules';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/users/{user_id}/notification_rules';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
