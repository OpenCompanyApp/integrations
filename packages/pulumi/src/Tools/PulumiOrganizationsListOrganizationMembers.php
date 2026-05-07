<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListOrganizationMembers.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/members.
 */
class PulumiOrganizationsListOrganizationMembers extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_organization_members';
    protected const DESCRIPTION = 'ListOrganizationMembers

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/members

ListOrganizationMembers lists the members of an organization. This API unfortunately has two different "modes", returning either the organization\'s "frontend members" or "backend members". - A "frontend member" is data stored in the Pulumi Service\'s database. For organizations billed per-member, this is the set of members that are counted against the organization\'s seat cap. - A "backend member" is data stored in the organization\'s backend. (e.g. GitHub, GitLab, or for SAML orgs, also the Pulumi Service database.) This isn\'t ideal, but is required so that the APIs can be paginated correctly while not returning any users twice. (Which would be impossible in some cases.)';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Token for paginated result retrieval',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `type` from the official Pulumi Cloud API operation. Member type to list: \'frontend\' for Pulumi Service members or \'backend\' for organization backend members',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/members';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'type' => 'type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
