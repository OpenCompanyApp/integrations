<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListStackTeams.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/teams.
 */
class PulumiStacksListStackTeams extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_list_stack_teams';
    protected const DESCRIPTION = 'ListStackTeams

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/teams

Lists all teams within the organization that have been granted access to the specified stack. The response includes each team\'s name and the permission level granted to it for this stack.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/teams';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
