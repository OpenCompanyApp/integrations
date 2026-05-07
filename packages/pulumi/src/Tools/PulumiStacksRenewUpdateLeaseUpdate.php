<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RenewUpdateLease.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/renew_lease.
 */
class PulumiStacksRenewUpdateLeaseUpdate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_renew_update_lease_update';
    protected const DESCRIPTION = 'RenewUpdateLease

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/renew_lease

Renews the lease for a service-managed update that is currently in progress. Leases prevent concurrent operations on the same stack and must be periodically renewed to indicate the update is still active. The renewal duration must be between 0 and 300 seconds. Returns 409 if the update is not currently in progress.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
  'update_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `updateID` from the official Pulumi Cloud API operation. The update ID',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/update/{updateID}/renew_lease';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'updateID' => 'update_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
