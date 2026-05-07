<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * show counterparty.
 *
 * Maps to the official Modern Treasury endpoint get /api/counterparties/{id}.
 */
class ModernTreasuryGetCounterparty extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_counterparty';
    protected const DESCRIPTION = 'show counterparty

Official Modern Treasury endpoint: GET /api/counterparties/{id}

Get details on a single counterparty.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/counterparties/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
