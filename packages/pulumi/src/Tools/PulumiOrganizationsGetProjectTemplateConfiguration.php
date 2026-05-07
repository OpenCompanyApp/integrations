<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetProjectTemplateConfiguration.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/template/configuration.
 */
class PulumiOrganizationsGetProjectTemplateConfiguration extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_project_template_configuration';
    protected const DESCRIPTION = 'GetProjectTemplateConfiguration

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/template/configuration

GetProjectTemplateConfiguration attempts to lookup any config we store for the template using the template query parameter passed in as a key into the org\'s template sources.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/template/configuration';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
