<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get opensource broker setting for organization.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/settings/opensource/broker.
 */
class SnykGetOpensourceBrokerSetting extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_opensource_broker_setting';
    protected const DESCRIPTION = 'Get opensource broker setting for organization

Official Snyk endpoint: GET /orgs/{org_id}/settings/opensource/broker

Returns whether the opensource broker setting is enabled for the organization #### Required permissions - `View Organization (org.read)`';
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
);
    protected const METHOD = 'get';
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
