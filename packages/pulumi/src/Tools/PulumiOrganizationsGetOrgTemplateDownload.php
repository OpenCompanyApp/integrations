<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrgTemplateDownload.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/template/download.
 */
class PulumiOrganizationsGetOrgTemplateDownload extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_org_template_download';
    protected const DESCRIPTION = 'GetOrgTemplateDownload

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/template/download

Downloads a template archive for an organization as an application/x-tar binary stream. The template is identified by a URL query parameter pointing to the template source. Returns the tar archive containing the template\'s project files and configuration.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/template/download';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
