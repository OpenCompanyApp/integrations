<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List enabled feature flags for an organization.
 *
 * Maps to the official WorkOS endpoint get /organizations/{organizationId}/feature-flags.
 */
class WorkOSOrganizationFeatureFlagsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organization_feature_flags_list';
    protected const DESCRIPTION = 'List enabled feature flags for an organization

Official WorkOS endpoint: GET /organizations/{organizationId}/feature-flags

Get a list of all enabled feature flags for an organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organizationId` from the official WorkOS API operation.',
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
    protected const PATH = '/organizations/{organizationId}/feature-flags';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
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
