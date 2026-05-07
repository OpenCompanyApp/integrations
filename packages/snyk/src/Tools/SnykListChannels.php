<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a list of Slack channels.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/slack_app/{tenant_id}/channels.
 */
class SnykListChannels extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_channels';
    protected const DESCRIPTION = 'Get a list of Slack channels

Official Snyk endpoint: GET /orgs/{org_id}/slack_app/{tenant_id}/channels

Requires the Snyk Slack App to be set up for this org, will retrieve a list of channels the Snyk Slack App can access. Note that it is currently only possible to page forwards through this collection, no prev links will be generated and the ending_before parameter will not function. #### Required permissions - `Install Apps (org.app.install)`';
    protected const PARAMETERS = array (
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. Tenant ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/slack_app/{tenant_id}/channels';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'tenant_id' => 'tenant_id',
);
    protected const QUERY_PARAMS = array (
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
