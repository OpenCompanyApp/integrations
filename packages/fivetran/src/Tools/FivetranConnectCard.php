<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create a Connect Card.
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/connect-card.
 */
class FivetranConnectCard extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_connect_card';
    protected const DESCRIPTION = 'Create a Connect Card

Official Fivetran endpoint: POST /v1/connections/{connectionId}/connect-card

Generates the Connect Card URI for the connection';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Fivetran API operation. The unique identifier for the connection within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/connections/{connectionId}/connect-card';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
