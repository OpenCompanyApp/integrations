<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a ticket.
 *
 * Maps to the official FireHydrant endpoint post /v1/ticketing/tickets.
 */
class FireHydrantCreateTicket extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_ticket';
    protected const DESCRIPTION = 'Create a ticket

Official FireHydrant endpoint: POST /v1/ticketing/tickets

Creates a ticket for a project';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/ticketing/tickets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
