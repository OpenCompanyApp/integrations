<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List Broker connections for a given organization.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/brokers/connections.
 */
class SnykListBrokerConnectionsForOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_broker_connections_for_org';
    protected const DESCRIPTION = 'List Broker connections for a given organization

Official Snyk endpoint: GET /orgs/{org_id}/brokers/connections

List all Broker connections integrated with a given org #### Required permissions - `View Organization (org.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/brokers/connections';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'ending_before' => 'ending_before',
  'starting_after' => 'starting_after',
  'limit' => 'limit',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
