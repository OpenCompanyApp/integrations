<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * SubmitChangeRequest.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/change-requests/{orgName}/{changeRequestID}/submit.
 */
class PulumiOrganizationsSubmit extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_submit';
    protected const DESCRIPTION = 'SubmitChangeRequest

Official Pulumi Cloud endpoint: POST /api/change-requests/{orgName}/{changeRequestID}/submit

Submits a draft change request for approval. Once submitted, the request enters the review workflow and requires the configured number of approvals before it can be applied.';
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
    protected const PATH = '/api/change-requests/{orgName}/{changeRequestID}/submit';
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
