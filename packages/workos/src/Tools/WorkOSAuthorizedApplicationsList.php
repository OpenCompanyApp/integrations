<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List authorized applications.
 *
 * Maps to the official WorkOS endpoint get /user_management/users/{user_id}/authorized_applications.
 */
class WorkOSAuthorizedApplicationsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorized_applications_list';
    protected const DESCRIPTION = 'List authorized applications

Official WorkOS endpoint: GET /user_management/users/{user_id}/authorized_applications

Get a list of all Connect applications that the user has authorized.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `user_id` from the official WorkOS API operation.',
  ),
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
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/users/{user_id}/authorized_applications';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
