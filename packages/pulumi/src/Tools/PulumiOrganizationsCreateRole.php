<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateRole.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/roles.
 */
class PulumiOrganizationsCreateRole extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_role';
    protected const DESCRIPTION = 'CreateRole

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/roles

Creates a new custom role for an organization. Custom roles define fine-grained permission sets that can be assigned to organization members and teams, enabling precise access control beyond the built-in admin and member roles. Optionally, an associated policy and role binding can be created alongside the role.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'create_policy_and_role' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `createPolicyAndRole` from the official Pulumi Cloud API operation. Also create an associated policy and role binding alongside the role',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/roles';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'createPolicyAndRole' => 'create_policy_and_role',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
