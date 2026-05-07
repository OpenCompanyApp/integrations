<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListTeams.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/teams.
 */
class PulumiOrganizationsListTeams extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_teams';
    protected const DESCRIPTION = 'ListTeams

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/teams

Retrieves all teams within an organization. Teams provide a centralized way to manage stack access permissions for groups of users. The response includes each team\'s name, type (Pulumi-managed, GitHub-backed, or GitLab-backed), member count, and summary of stack permissions. Teams are available to organizations on Enterprise and Business Critical editions.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/teams';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
