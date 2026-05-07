<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List org policy events (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/policies/{policy_id}/events.
 */
class SnykGetOrgPolicyEvents extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_org_policy_events';
    protected const DESCRIPTION = 'List org policy events (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/policies/{policy_id}/events

Retrieve the event history for the given policy. *Org level Policy APIs Access Notice:* Access to our Org level Policy APIs is currently restricted via "snykCodeConsistentIgnores" and "ignoreApprovalWorkflow" feature flags and will result in a 403 Forbidden error without the flag enabled. Please contact your account representative for eligibility requirements. #### Required permissions - `View Ignores (org.project.ignore.read)`';
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
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'policy_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `policy_id` from the official Snyk API operation. Policy ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/policies/{policy_id}/events';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'policy_id' => 'policy_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
