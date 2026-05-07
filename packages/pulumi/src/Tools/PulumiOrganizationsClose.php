<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CloseChangeRequest.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/change-requests/{orgName}/{changeRequestID}/close.
 */
class PulumiOrganizationsClose extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_close';
    protected const DESCRIPTION = 'CloseChangeRequest

Official Pulumi Cloud endpoint: POST /api/change-requests/{orgName}/{changeRequestID}/close

Closes a change request without applying it. The proposed infrastructure changes are discarded and the request is marked as closed.';
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
    protected const PATH = '/api/change-requests/{orgName}/{changeRequestID}/close';
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
