<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Search for Zendesk tickets.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/zendesk/search.
 */
class FireHydrantGetZendeskCustomerSupportIssue extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_zendesk_customer_support_issue';
    protected const DESCRIPTION = 'Search for Zendesk tickets

Official FireHydrant endpoint: GET /v1/integrations/zendesk/search

Search for Zendesk tickets';
    protected const PARAMETERS = array (
  'ticket_id' =>
  array (
    'type' => 'string',
    'description' => 'Zendesk ticket ID',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'Use to include attached_incidents',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/zendesk/search';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'ticket_id' => 'ticket_id',
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
