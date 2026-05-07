<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update legal entity.
 *
 * Maps to the official Modern Treasury endpoint patch /api/legal_entities/{id}.
 */
class ModernTreasuryUpdateLegalEntity extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_legal_entity';
    protected const DESCRIPTION = 'update legal entity

Official Modern Treasury endpoint: PATCH /api/legal_entities/{id}

Update a legal entity.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/legal_entities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
