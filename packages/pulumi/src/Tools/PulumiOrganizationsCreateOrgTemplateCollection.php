<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateOrgTemplateCollection.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/templates/sources.
 */
class PulumiOrganizationsCreateOrgTemplateCollection extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_org_template_collection';
    protected const DESCRIPTION = 'CreateOrgTemplateCollection

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/templates/sources

Creates a new template collection (source) for an organization. Template collections define where project templates are sourced from, such as a Git repository. Organization members can use these templates to create new stacks with pre-configured infrastructure code.';
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
    protected const PATH = '/api/orgs/{orgName}/templates/sources';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
