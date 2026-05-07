<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Enable opensource broker for organization.
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/settings/opensource/broker.
 */
class SnykEnableOpensourceBrokerForOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_enable_opensource_broker_for_org';
    protected const DESCRIPTION = 'Enable opensource broker for organization

Official Snyk endpoint: POST /orgs/{org_id}/settings/opensource/broker

Enables the opensource broker setting for an organization by installing the Snyk App #### Required permissions - `Install Apps (org.app.install)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/settings/opensource/broker';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
