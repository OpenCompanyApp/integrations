<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive a ticket.
 *
 * Maps to the official FireHydrant endpoint delete /v1/ticketing/tickets/{ticket_id}.
 */
class FireHydrantDeleteTicket extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_ticket';
    protected const DESCRIPTION = 'Archive a ticket

Official FireHydrant endpoint: DELETE /v1/ticketing/tickets/{ticket_id}

Archive a ticket';
    protected const PARAMETERS = array (
  'ticket_id' =>
  array (
    'type' => 'string',
    'description' => 'ticket_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
