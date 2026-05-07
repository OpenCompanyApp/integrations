<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update legal entity status.
 *
 * Maps to the official Modern Treasury endpoint patch /api/simulations/legal_entities/{id}/update_status.
 */
class ModernTreasuryUpdateLegalEntityStatus extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_legal_entity_status';
    protected const DESCRIPTION = 'update legal entity status

Official Modern Treasury endpoint: PATCH /api/simulations/legal_entities/{id}/update_status

Update Legal Entity Status (sandbox only)';
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
    protected const PATH = '/api/simulations/legal_entities/{id}/update_status';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
