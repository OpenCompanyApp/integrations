<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateChangeGate.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/change-gates/{orgName}/{gateID}.
 */
class PulumiOrganizationsUpdateGate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_gate';
    protected const DESCRIPTION = 'UpdateChangeGate

Official Pulumi Cloud endpoint: PUT /api/change-gates/{orgName}/{gateID}

Updates the configuration of an existing change gate, such as modifying its approval requirements or protected entity.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'gate_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `gateID` from the official Pulumi Cloud API operation. The change gate identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/api/change-gates/{orgName}/{gateID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'gateID' => 'gate_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
