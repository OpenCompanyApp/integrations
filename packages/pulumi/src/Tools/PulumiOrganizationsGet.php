<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadChangeRequest.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/change-requests/{orgName}/{changeRequestID}.
 */
class PulumiOrganizationsGet extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get';
    protected const DESCRIPTION = 'ReadChangeRequest

Official Pulumi Cloud endpoint: GET /api/change-requests/{orgName}/{changeRequestID}

Retrieves the details of a specific change request, including its current status, description, approvals, and the proposed infrastructure changes.';
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
    protected const METHOD = 'get';
    protected const PATH = '/api/change-requests/{orgName}/{changeRequestID}';
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
