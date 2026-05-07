<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List users.
 *
 * Maps to the official Brex endpoint get /v2/users.
 */
class BrexTeamListUsers extends AbstractBrexTool
{
    protected const NAME = 'brex_team_list_users';
    protected const DESCRIPTION = 'List users

Official Brex endpoint: GET /v2/users

This endpoint lists all users. To find a user id by email, you can filter using the `email` query parameter.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
  'email' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `email` from the official Brex API operation.',
  ),
  'remote_display_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `remote_display_id` from the official Brex API operation.',
  ),
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand[]` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
  'email' => 'email',
  'remote_display_id' => 'remote_display_id',
  'expand[]' => 'expand',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
