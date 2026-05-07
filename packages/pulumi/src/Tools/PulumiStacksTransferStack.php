<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * TransferStack.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/transfer.
 */
class PulumiStacksTransferStack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_transfer_stack';
    protected const DESCRIPTION = 'TransferStack

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/transfer

Transfers a stack from one organization to another. The request body must specify the destination organization name via the \'toOrg\' field. The requesting user must be a member of both the source and destination organizations to prevent accidental disclosure of organization existence. The stack must not have any active updates in progress (returns 409 if an update is running). Returns 204 with no content on success.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/transfer';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
