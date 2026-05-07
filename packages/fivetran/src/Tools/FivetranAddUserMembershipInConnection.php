<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Add a Connection Membership.
 *
 * Maps to the official Fivetran endpoint post /v1/users/{userId}/connections.
 */
class FivetranAddUserMembershipInConnection extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_add_user_membership_in_connection';
    protected const DESCRIPTION = 'Add a Connection Membership

Official Fivetran endpoint: POST /v1/users/{userId}/connections

Adds a connection membership';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId` from the official Fivetran API operation. The unique identifier for the user within the account.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/users/{userId}/connections';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
