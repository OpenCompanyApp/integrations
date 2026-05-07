<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateOrganizationKey.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/cmk.
 */
class PulumiOrganizationsCreateOrganizationKey extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_organization_key';
    protected const DESCRIPTION = 'CreateOrganizationKey

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/cmk

Creates a new customer managed key (CMK) for an organization, allowing the organization to use their own encryption keys for securing secrets stored in Pulumi Cloud. The key must be a valid cloud provider key (e.g., AWS KMS). Once created, the key can be set as the default encryption key for all new stacks in the organization.';
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
