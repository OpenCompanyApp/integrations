<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UnapproveChangeRequest.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/change-requests/{orgName}/{changeRequestID}/approve.
 */
class PulumiOrganizationsUnapprove extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_unapprove';
    protected const DESCRIPTION = 'UnapproveChangeRequest

Official Pulumi Cloud endpoint: DELETE /api/change-requests/{orgName}/{changeRequestID}/approve

Withdraws a previously given approval for a change request. If the change request no longer has the required number of approvals after withdrawal, it cannot be applied until additional approvals are granted.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'change_request_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `changeRequestID` from the official Pulumi Cloud API operation. The change request identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/change-requests/{orgName}/{changeRequestID}/approve';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'changeRequestID' => 'change_request_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
