<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a ticket.
 *
 * Maps to the official FireHydrant endpoint patch /v1/ticketing/tickets/{ticket_id}.
 */
class FireHydrantUpdateTicket extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_ticket';
    protected const DESCRIPTION = 'Update a ticket

Official FireHydrant endpoint: PATCH /v1/ticketing/tickets/{ticket_id}

Update a ticket\'s attributes';
    protected const PARAMETERS = array (
  'ticket_id' =>
  array (
    'type' => 'string',
    'description' => 'ticket_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/ticketing/tickets/{ticket_id}';
    protected const PATH_PARAMS = array (
  'ticket_id' => 'ticket_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
