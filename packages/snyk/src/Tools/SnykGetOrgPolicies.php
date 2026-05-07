<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get org-level policies.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/policies.
 */
class SnykGetOrgPolicies extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_org_policies';
    protected const DESCRIPTION = 'Get org-level policies

Official Snyk endpoint: GET /orgs/{org_id}/policies

Get all policies for the requested organisation. *Org level Policy APIs Access Notice:* Org level Policy APIs are only available for use with Code Consistent Ignores. For information about how to enable Code Consistent Ignores see [this](https://docs.snyk.io/manage-risk/prioritize-issues-for-fixing/ignore-issues/consistent-ignores-for-snyk-code#enable-snyk-code-consistent-ignores) documentation. #### Required permissions - `View Ignores (org.project.ignore.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
  'search' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `search` from the official Snyk API operation. Search keyword for searching fields ignored_by.name, ignored_by.email, ignore_type in policy_rules',
  ),
  'order_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order_by` from the official Snyk API operation. The column name to sort on',
    'enum' =>
    array (
      0 => 'created',
      1 => 'expires',
      2 => 'ignore-type',
      3 => 'requested-by',
    ),
  ),
  'order_direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order_direction` from the official Snyk API operation. Sorting direction ASC/DESC',
    'enum' =>
    array (
      0 => 'asc',
      1 => 'desc',
    ),
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'review' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `review` from the official Snyk API operation. Policy rule review state e.g. approved',
  ),
  'expires_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `expires_before` from the official Snyk API operation. Select only policies with an expiry strictly before the given time.',
  ),
  'expires_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `expires_after` from the official Snyk API operation. Select only policies with an expiry strictly past the given time.',
  ),
  'expires_never' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `expires_never` from the official Snyk API operation. Select only policies that never expire.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/policies';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'search' => 'search',
  'order_by' => 'order_by',
  'order_direction' => 'order_direction',
  'review' => 'review',
  'expires_before' => 'expires_before',
  'expires_after' => 'expires_after',
  'expires_never' => 'expires_never',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
