<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListChangeRequestEvents.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/change-requests/{orgName}/{changeRequestID}/events.
 */
class PulumiOrganizationsListEvents extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_events';
    protected const DESCRIPTION = 'ListChangeRequestEvents

Official Pulumi Cloud endpoint: GET /api/change-requests/{orgName}/{changeRequestID}/events

Lists the event log for a change request, including approvals, status changes, and other lifecycle events. Supports pagination via continuation token.';
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
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/change-requests/{orgName}/{changeRequestID}/events';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'changeRequestID' => 'change_request_id',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
