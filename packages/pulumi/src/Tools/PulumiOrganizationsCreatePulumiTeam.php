<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreatePulumiTeam.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/teams/pulumi.
 */
class PulumiOrganizationsCreatePulumiTeam extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_pulumi_team';
    protected const DESCRIPTION = 'CreatePulumiTeam

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/teams/pulumi

CreatePulumiTeam creates a "Pulumi" team, i.e. one whose membership is managed by Pulumi. (As opposed to a GitHub or GitLab-based team.)';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/teams/pulumi';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
