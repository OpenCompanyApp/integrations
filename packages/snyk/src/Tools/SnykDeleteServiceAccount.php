<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete a service account in an organization..
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/service_accounts/{serviceaccount_id}.
 */
class SnykDeleteServiceAccount extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_service_account';
    protected const DESCRIPTION = 'Delete a service account in an organization.

Official Snyk endpoint: DELETE /orgs/{org_id}/service_accounts/{serviceaccount_id}

Delete a service account in an organization. #### Required permissions - `Remove service accounts (org.service_account.delete)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The ID of org to which the service account belongs.',
  ),
  'serviceaccount_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `serviceaccount_id` from the official Snyk API operation. The ID of the service account.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/service_accounts/{serviceaccount_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'serviceaccount_id' => 'serviceaccount_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
