<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrgTemplateReadme.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/template/readme.
 */
class PulumiOrganizationsGetOrgTemplateReadme extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_org_template_readme';
    protected const DESCRIPTION = 'GetOrgTemplateReadme

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/template/readme

Returns the README content for an organization template as Markdown text. The template is identified by a URL query parameter. Returns 404 if the template does not contain a README.md file, or 422 if the README content is invalid.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/template/readme';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
