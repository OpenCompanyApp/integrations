<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateChangeGate.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/change-gates/{orgName}.
 */
class PulumiOrganizationsCreateGate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_gate';
    protected const DESCRIPTION = 'CreateChangeGate

Official Pulumi Cloud endpoint: POST /api/change-gates/{orgName}

Creates a new change gate for an entity in the organization. Change gates enforce approval workflows by requiring one or more approvals before infrastructure changes can be applied to the protected resource.';
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
    protected const PATH = '/api/change-gates/{orgName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
