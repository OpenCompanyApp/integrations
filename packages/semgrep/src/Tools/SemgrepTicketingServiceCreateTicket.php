<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Create Jira tickets.
 *
 * Maps to the official Semgrep Web API endpoint post /api/v1/deployments/{deploymentSlug}/tickets.
 */
class SemgrepTicketingServiceCreateTicket extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_ticketing_service_create_ticket';
    protected const DESCRIPTION = 'Create Jira tickets

Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentSlug}/tickets

Create Jira tickets for your findings. You can create tickets by passing in a list of issue_ids or by passing in filter query parameters to dynamically select findings. If passing in filters, Semgrep will skip already ticketed findings. This endpoint is synchronous, so it may take some time for your request to resolve. Unlike creating tickets in-app, if ticket creation fails we won\'t automatically retry. This endpoint accepts a limit parameter (defaulting to 20) to limit the number of tickets created per request. If you specify a list of issue_ids greater than this limit, or your selected filters match on a number of issues greater than this limit, issues that were not ticketed are included in the Failed part of the response object. You can send another request to create tickets for these skipped issues. By default, findings belonging to the same repository and the same rule will be grouped together into a single Jira ticket. You can override this using the group_issues query parameter. Up to 50 issues can be grouped into a single ticket. You can optionally override the Jira project you create tickets in by passing in a Jira project ID as jira_project_id (the numeric ID rather than the project key). You can fetch this ID using the Jira API.';
    protected const PARAMETERS = array (
  'deployment_slug' =>
  array (
    'type' => 'string',
    'description' => 'deploymentSlug parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Semgrep Web API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/deployments/{deploymentSlug}/tickets';
    protected const PATH_PARAMS = array (
  'deploymentSlug' => 'deployment_slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
