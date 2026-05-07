<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List ticket tags.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/ticket_tags.
 */
class FireHydrantListTicketTags extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_ticket_tags';
    protected const DESCRIPTION = 'List ticket tags

Official FireHydrant endpoint: GET /v1/ticketing/ticket_tags

List all of the ticket tags in the organization';
    protected const PARAMETERS = array (
  'prefix' =>
  array (
    'type' => 'string',
    'description' => 'prefix parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/ticket_tags';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'prefix' => 'prefix',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
