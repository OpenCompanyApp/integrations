<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Search for Zendesk tickets.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/zendesk/{connection_id}/tickets/search.
 */
class FireHydrantSearchZendeskTickets extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_search_zendesk_tickets';
    protected const DESCRIPTION = 'Search for Zendesk tickets

Official FireHydrant endpoint: GET /v1/integrations/zendesk/{connection_id}/tickets/search

Search for Zendesk tickets';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'connection_id parameter.',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'query parameter.',
    'required' => true,
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/zendesk/{connection_id}/tickets/search';
    protected const PATH_PARAMS = array (
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
