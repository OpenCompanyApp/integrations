<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ApproveChangeRequest.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/change-requests/{orgName}/{changeRequestID}/approve.
 */
class PulumiOrganizationsApprove extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_approve';
    protected const DESCRIPTION = 'ApproveChangeRequest

Official Pulumi Cloud endpoint: POST /api/change-requests/{orgName}/{changeRequestID}/approve

Records an approval for a change request from the authenticated user. Once the required number of approvals is met, the change request can be applied.';
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
    protected const METHOD = 'post';
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
