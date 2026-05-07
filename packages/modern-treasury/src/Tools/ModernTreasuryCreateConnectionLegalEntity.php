<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * create connection_legal_entity.
 *
 * Maps to the official Modern Treasury endpoint post /api/connection_legal_entities.
 */
class ModernTreasuryCreateConnectionLegalEntity extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_create_connection_legal_entity';
    protected const DESCRIPTION = 'create connection_legal_entity

Official Modern Treasury endpoint: POST /api/connection_legal_entities

Create a connection legal entity.';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/connection_legal_entities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = false;
}
