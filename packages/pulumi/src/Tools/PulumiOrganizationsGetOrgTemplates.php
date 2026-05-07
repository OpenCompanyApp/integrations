<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrgTemplates.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/templates.
 */
class PulumiOrganizationsGetOrgTemplates extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_org_templates';
    protected const DESCRIPTION = 'GetOrgTemplates

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/templates

Returns a combined list of all templates available to the organization and the current user. This includes templates from the organization\'s configured template collections as well as Pulumi\'s built-in public templates. Each template includes its name, description, language, and source URL.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/templates';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
