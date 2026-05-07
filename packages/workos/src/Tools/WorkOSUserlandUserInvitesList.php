<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List invitations.
 *
 * Maps to the official WorkOS endpoint get /user_management/invitations.
 */
class WorkOSUserlandUserInvitesList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_invites_list';
    protected const DESCRIPTION = 'List invitations

Official WorkOS endpoint: GET /user_management/invitations

Get a list of all of invitations matching the criteria specified.';
    protected const PARAMETERS = array (
  'before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `before` from the official WorkOS API operation.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after` from the official WorkOS API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official WorkOS API operation.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order` from the official WorkOS API operation.',
  ),
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization_id` from the official WorkOS API operation.',
  ),
  'email' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `email` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/invitations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'organization_id' => 'organization_id',
  'email' => 'email',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
