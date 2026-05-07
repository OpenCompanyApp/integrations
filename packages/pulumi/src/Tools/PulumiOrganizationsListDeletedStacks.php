<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListDeletedStacks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/restore-stack.
 */
class PulumiOrganizationsListDeletedStacks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_deleted_stacks';
    protected const DESCRIPTION = 'ListDeletedStacks

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/restore-stack

ListDeletedStacks returns the last 25 deleted stacks for a given org. It would be incredible to one day merge this function with `ListOrganizationProjects` -- but that function is very bloated and not performant, so implementing a lighter-weight handler focusing only on the most recently deleted stacks.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/restore-stack';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
