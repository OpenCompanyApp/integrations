<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Link an existing ticket to findings.
 *
 * Maps to the official Semgrep Web API endpoint post /api/v1/deployments/{deploymentId}/tickets/link.
 */
class SemgrepTicketingServiceLinkTicket extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_ticketing_service_link_ticket';
    protected const DESCRIPTION = 'Link an existing ticket to findings

Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/tickets/link

Link an existing external ticket (e.g. Jira) to one or more Semgrep findings by providing the ticket URL and a list of finding IDs. This does not create a ticket in your issue tracker — it only records the association in Semgrep. If a finding is already linked to a different ticket, the existing link is replaced. Requires a configured ticketing integration.';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'description' => 'deploymentId parameter.',
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
    protected const PATH = '/api/v1/deployments/{deploymentId}/tickets/link';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
