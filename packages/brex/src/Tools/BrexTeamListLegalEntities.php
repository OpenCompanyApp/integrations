<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List legal entities.
 *
 * Maps to the official Brex endpoint get /v2/legal_entities.
 */
class BrexTeamListLegalEntities extends AbstractBrexTool
{
    protected const NAME = 'brex_team_list_legal_entities';
    protected const DESCRIPTION = 'List legal entities

Official Brex endpoint: GET /v2/legal_entities

List legal entities for the account.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/legal_entities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
