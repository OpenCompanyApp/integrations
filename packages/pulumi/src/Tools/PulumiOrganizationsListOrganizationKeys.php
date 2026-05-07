<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListOrganizationKeys.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/cmk.
 */
class PulumiOrganizationsListOrganizationKeys extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_organization_keys';
    protected const DESCRIPTION = 'ListOrganizationKeys

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/cmk

Returns all customer managed keys (CMK) configured for an organization, including their key identifiers, cloud provider details, enabled status, and which key is set as the default for new stacks.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/cmk';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
