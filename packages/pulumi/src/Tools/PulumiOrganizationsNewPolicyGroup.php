<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * NewPolicyGroup.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/policygroups.
 */
class PulumiOrganizationsNewPolicyGroup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_new_policy_group';
    protected const DESCRIPTION = 'NewPolicyGroup

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/policygroups

Creates a new Policy Group for an organization. Policy Groups define which Policy Packs are enforced on which stacks or cloud accounts, with configurable enforcement levels (advisory, mandatory, or disabled) per pack. This allows different policy strictness for different environments, such as advisory-only in development and mandatory in production.';
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
    protected const PATH = '/api/orgs/{orgName}/policygroups';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
