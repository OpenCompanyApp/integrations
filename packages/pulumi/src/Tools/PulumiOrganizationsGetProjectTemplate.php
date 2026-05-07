<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetProjectTemplate.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/template.
 */
class PulumiOrganizationsGetProjectTemplate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_project_template';
    protected const DESCRIPTION = 'GetProjectTemplate

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/template

GetProjectTemplate attempts to fetch Pulumi.yaml from a template repository. If the repository represents a valid template, we return a response identical to the format we use for the public pulumi/templates repo. This API accepts either a `url` or `project` query param to denote either where to fetch the project template from or which project\'s pre-configured template to use respectively. If both are passed in `project` take precedence, falling back to `url` if there is no source configured on the project.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/template';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
