<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete opensource broker setting for organization.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/settings/opensource/broker.
 */
class SnykDeleteOpensourceBrokerSettingForOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_opensource_broker_setting_for_org';
    protected const DESCRIPTION = 'Delete opensource broker setting for organization

Official Snyk endpoint: DELETE /orgs/{org_id}/settings/opensource/broker

Deletes the opensource broker setting for the organization by uninstalling the Snyk App #### Required permissions - `Install Apps (org.app.install)`';
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
    protected const METHOD = 'delete';
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
