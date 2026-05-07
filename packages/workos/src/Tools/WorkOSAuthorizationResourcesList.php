<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List resources.
 *
 * Maps to the official WorkOS endpoint get /authorization/resources.
 */
class WorkOSAuthorizationResourcesList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_list';
    protected const DESCRIPTION = 'List resources

Official WorkOS endpoint: GET /authorization/resources

Get a paginated list of authorization resources.';
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
  'resource_type_slug' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `resource_type_slug` from the official WorkOS API operation.',
  ),
  'resource_external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `resource_external_id` from the official WorkOS API operation.',
  ),
  'parent_resource_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `parent_resource_id` from the official WorkOS API operation.',
  ),
  'parent_resource_type_slug' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `parent_resource_type_slug` from the official WorkOS API operation.',
  ),
  'parent_external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `parent_external_id` from the official WorkOS API operation.',
  ),
  'search' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `search` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/resources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'organization_id' => 'organization_id',
  'resource_type_slug' => 'resource_type_slug',
  'resource_external_id' => 'resource_external_id',
  'parent_resource_id' => 'parent_resource_id',
  'parent_resource_type_slug' => 'parent_resource_type_slug',
  'parent_external_id' => 'parent_external_id',
  'search' => 'search',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
