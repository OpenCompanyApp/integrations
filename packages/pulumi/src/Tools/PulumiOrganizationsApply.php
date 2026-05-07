<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ApplyChangeRequest.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/change-requests/{orgName}/{changeRequestID}/apply.
 */
class PulumiOrganizationsApply extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_apply';
    protected const DESCRIPTION = 'ApplyChangeRequest

Official Pulumi Cloud endpoint: POST /api/change-requests/{orgName}/{changeRequestID}/apply

Applies an approved change request, triggering the execution of the proposed infrastructure changes. The change request must have received the required number of approvals before it can be applied. Returns 409 if there is a conflict preventing application.';
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
);
    protected const METHOD = 'post';
    protected const PATH = '/api/change-requests/{orgName}/{changeRequestID}/apply';
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
