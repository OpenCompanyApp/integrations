<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadChangeGate.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/change-gates/{orgName}/{gateID}.
 */
class PulumiOrganizationsReadGate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_read_gate';
    protected const DESCRIPTION = 'ReadChangeGate

Official Pulumi Cloud endpoint: GET /api/change-gates/{orgName}/{gateID}

Retrieves the configuration and status of a specific change gate, including its approval requirements and the entity it protects.';
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
);
    protected const METHOD = 'get';
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
