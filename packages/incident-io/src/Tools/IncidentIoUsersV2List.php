<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Users V2.
 *
 * Maps to the official incident.io endpoint get /v2/users.
 */
class IncidentIoUsersV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_users_v2_list';
    protected const DESCRIPTION = 'List Users V2

Official incident.io endpoint: GET /v2/users

List users in your account.';
    protected const PARAMETERS = array (
  'email' =>
  array (
    'type' => 'string',
    'description' => 'Filter by email address',
  ),
  'slack_user_id' =>
  array (
    'type' => 'string',
    'description' => 'Filter by Slack user ID',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Integer number of records to return',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An record\'s ID. This endpoint will return a list of records after this ID in relation to the API response order.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'email' => 'email',
  'slack_user_id' => 'slack_user_id',
  'page_size' => 'page_size',
  'after' => 'after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
