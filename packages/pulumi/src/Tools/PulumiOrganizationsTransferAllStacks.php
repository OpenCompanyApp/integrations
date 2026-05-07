<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * TransferAllStacks.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/bulk-transfer/stacks.
 */
class PulumiOrganizationsTransferAllStacks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_transfer_all_stacks';
    protected const DESCRIPTION = 'TransferAllStacks

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/bulk-transfer/stacks

TransferAllStacks transfers all active stacks from one org to another, where deleted stacks will be skipped/ignored. We are currently constraining usage of this function to organizations with less than or equal to TransferAllStacksMax stacks. NOTE: This operation will lock the organization while the transfer is in-progress, to rewrite all checkpoint files that use service-managed secrets. This means that the organization will be read-only and no stack updates can begin until the rename process has completed.';
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
    protected const PATH = '/api/orgs/{orgName}/bulk-transfer/stacks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
