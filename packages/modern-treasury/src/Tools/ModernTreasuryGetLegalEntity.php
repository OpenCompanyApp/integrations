<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get legal_entity.
 *
 * Maps to the official Modern Treasury endpoint get /api/legal_entities/{id}.
 */
class ModernTreasuryGetLegalEntity extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_legal_entity';
    protected const DESCRIPTION = 'get legal_entity

Official Modern Treasury endpoint: GET /api/legal_entities/{id}

Get details on a single legal entity.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/legal_entities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
