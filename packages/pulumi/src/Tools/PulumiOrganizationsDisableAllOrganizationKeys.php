<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DisableAllOrganizationKeys.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/cmk/disable.
 */
class PulumiOrganizationsDisableAllOrganizationKeys extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_disable_all_organization_keys';
    protected const DESCRIPTION = 'DisableAllOrganizationKeys

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/cmk/disable

Disables all customer managed keys (CMK) for an organization, reverting to Pulumi-managed encryption for secrets. After disabling, new stacks will use the default Pulumi-managed encryption rather than customer-provided keys.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/cmk/disable';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
