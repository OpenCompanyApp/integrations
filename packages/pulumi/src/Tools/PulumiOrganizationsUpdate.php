<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateChangeRequest.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/change-requests/{orgName}/{changeRequestID}.
 */
class PulumiOrganizationsUpdate extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update';
    protected const DESCRIPTION = 'UpdateChangeRequest

Official Pulumi Cloud endpoint: PATCH /api/change-requests/{orgName}/{changeRequestID}

Updates a change request\'s metadata. Currently only the description field can be modified after creation.';
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
    protected const METHOD = 'patch';
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
