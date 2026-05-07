<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Cancel a pending user invitations to an organization..
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/invites/{invite_id}.
 */
class SnykDeleteOrgInvitation extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_org_invitation';
    protected const DESCRIPTION = 'Cancel a pending user invitations to an organization.

Official Snyk endpoint: DELETE /orgs/{org_id}/invites/{invite_id}

Cancel a pending user invitations to an organization. #### Required permissions - `Invite users (org.user.invite)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org the user is being invited to',
  ),
  'invite_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `invite_id` from the official Snyk API operation. The id of the pending invite to cancel',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/invites/{invite_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'invite_id' => 'invite_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
