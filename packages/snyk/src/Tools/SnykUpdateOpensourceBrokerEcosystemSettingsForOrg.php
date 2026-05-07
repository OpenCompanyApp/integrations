<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update opensource broker settings of ecosystem for organization.
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/settings/opensource/{ecosystem}/broker.
 */
class SnykUpdateOpensourceBrokerEcosystemSettingsForOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_opensource_broker_ecosystem_settings_for_org';
    protected const DESCRIPTION = 'Update opensource broker settings of ecosystem for organization

Official Snyk endpoint: PATCH /orgs/{org_id}/settings/opensource/{ecosystem}/broker

Updates all Broker settings of a specific Open Source Ecosystem for an Organization. This endpoint has JSON-PATCH semantics: only provided Broker integrations are updated. Provide an empty value for `urls` to remove a Broker integration. #### Required permissions - `Edit Organization (org.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
    protected const BODY_REQUIRED = true;
}
