<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get opensource broker settings of ecosystem for organization.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/settings/opensource/{ecosystem}/broker.
 */
class SnykGetOpensourceBrokerEcosystemSettingsForOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_opensource_broker_ecosystem_settings_for_org';
    protected const DESCRIPTION = 'Get opensource broker settings of ecosystem for organization

Official Snyk endpoint: GET /orgs/{org_id}/settings/opensource/{ecosystem}/broker

Retrieves all Broker settings of a specific Open Source Ecosystem for an Organization #### Required permissions - `View Organization (org.read)`';
    protected const PARAMETERS = array (
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
  'ecosystem' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ecosystem` from the official Snyk API operation. The ecosystem identifier',
    'enum' =>
    array (
      0 => 'Dotnet',
      1 => 'Golang',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/settings/opensource/{ecosystem}/broker';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'ecosystem' => 'ecosystem',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
