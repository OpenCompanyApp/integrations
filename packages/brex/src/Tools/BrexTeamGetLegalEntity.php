<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get legal entity.
 *
 * Maps to the official Brex endpoint get /v2/legal_entities/{id}.
 */
class BrexTeamGetLegalEntity extends AbstractBrexTool
{
    protected const NAME = 'brex_team_get_legal_entity';
    protected const DESCRIPTION = 'Get legal entity

Official Brex endpoint: GET /v2/legal_entities/{id}

Get a legal entity by its ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/legal_entities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
