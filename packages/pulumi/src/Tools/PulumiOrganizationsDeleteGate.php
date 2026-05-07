<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteChangeGate.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/change-gates/{orgName}/{gateID}.
 */
class PulumiOrganizationsDeleteGate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_gate';
    protected const DESCRIPTION = 'DeleteChangeGate

Official Pulumi Cloud endpoint: DELETE /api/change-gates/{orgName}/{gateID}

Deletes a change gate, removing the approval requirement from the protected entity. Changes to the entity will no longer require approval.';
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
    protected const METHOD = 'delete';
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
