<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrgTemplateCollections.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/templates/sources.
 */
class PulumiOrganizationsGetOrgTemplateCollections extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_org_template_collections';
    protected const DESCRIPTION = 'GetOrgTemplateCollections

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/templates/sources

Returns all template collections (sources) configured for an organization. Template collections define where project templates are sourced from, such as Git repositories. Each collection includes its name, URL, and the templates it provides.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
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
