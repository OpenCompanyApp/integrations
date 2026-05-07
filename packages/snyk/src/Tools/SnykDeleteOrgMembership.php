<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Remove user's org membership.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/memberships/{membership_id}.
 */
class SnykDeleteOrgMembership extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_org_membership';
    protected const DESCRIPTION = 'Remove user\'s org membership

Official Snyk endpoint: DELETE /orgs/{org_id}/memberships/{membership_id}

Remove a user\'s membership of the group. #### Required permissions - `Delete Organization Memberships (org.membership.delete)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org',
  ),
  'membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `membership_id` from the official Snyk API operation. The id of the org membership',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/memberships/{membership_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'membership_id' => 'membership_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
