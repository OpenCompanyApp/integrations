<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a ticket.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/tickets/{ticket_id}.
 */
class FireHydrantGetTicket extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_ticket';
    protected const DESCRIPTION = 'Get a ticket

Official FireHydrant endpoint: GET /v1/ticketing/tickets/{ticket_id}

Retrieves a single ticket by ID';
    protected const PARAMETERS = array (
  'ticket_id' =>
  array (
    'type' => 'string',
    'description' => 'ticket_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/tickets/{ticket_id}';
    protected const PATH_PARAMS = array (
  'ticket_id' => 'ticket_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
