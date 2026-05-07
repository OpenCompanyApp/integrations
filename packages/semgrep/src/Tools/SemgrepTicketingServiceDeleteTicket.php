<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Unlink a Jira ticket.
 *
 * Maps to the official Semgrep Web API endpoint delete /api/v1/deployments/{deploymentId}/ticketing/v2/tickets/{externalTicketId}.
 */
class SemgrepTicketingServiceDeleteTicket extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_ticketing_service_delete_ticket';
    protected const DESCRIPTION = 'Unlink a Jira ticket

Official Semgrep Web API endpoint: DELETE /api/v1/deployments/{deploymentId}/ticketing/v2/tickets/{externalTicketId}

Unlink a Jira ticket by its ID';
    protected const PARAMETERS = array (
  'deployment_id' =>
  array (
    'type' => 'string',
    'description' => 'deploymentId parameter.',
    'required' => true,
  ),
  'external_ticket_id' =>
  array (
    'type' => 'integer',
    'description' => 'externalTicketId parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v1/deployments/{deploymentId}/ticketing/v2/tickets/{externalTicketId}';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
  'externalTicketId' => 'external_ticket_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
