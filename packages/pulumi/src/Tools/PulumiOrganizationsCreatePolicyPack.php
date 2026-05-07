<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreatePolicyPack.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/policypacks.
 */
class PulumiOrganizationsCreatePolicyPack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_policy_pack';
    protected const DESCRIPTION = 'CreatePolicyPack

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/policypacks

Creates a new Policy Pack for an organization. A Policy Pack is a versioned collection of related policies that validate infrastructure configuration during deployments. Policies can enforce rules such as requiring encryption on storage buckets or prohibiting public access to databases. The pack must contain at least one policy. Once created, the pack can be applied to Policy Groups to enforce rules on specific stacks with configurable enforcement levels (advisory, mandatory, or disabled).';
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
    protected const PATH = '/api/orgs/{orgName}/policypacks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
