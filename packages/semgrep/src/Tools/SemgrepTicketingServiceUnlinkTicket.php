<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * Unlink a ticket from findings.
 *
 * Maps to the official Semgrep Web API endpoint post /api/v1/deployments/{deploymentId}/tickets/unlink.
 */
class SemgrepTicketingServiceUnlinkTicket extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_ticketing_service_unlink_ticket';
    protected const DESCRIPTION = 'Unlink a ticket from findings

Official Semgrep Web API endpoint: POST /api/v1/deployments/{deploymentId}/tickets/unlink

Remove the ticket association from one or more Semgrep findings by providing a list of finding IDs. This does not delete the ticket in your issue tracker — it only removes the association in Semgrep.';
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
    protected const PATH = '/api/v1/deployments/{deploymentId}/tickets/unlink';
    protected const PATH_PARAMS = array (
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
