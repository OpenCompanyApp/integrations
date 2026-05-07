<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Invite a user to an organization.
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/invites.
 */
class SnykCreateOrgInvitation extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_org_invitation';
    protected const DESCRIPTION = 'Invite a user to an organization

Official Snyk endpoint: POST /orgs/{org_id}/invites

Invite a user to an organization with a role. #### Required permissions - `Invite users (org.user.invite)`';
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org the user is being invited to',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/invites';
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
