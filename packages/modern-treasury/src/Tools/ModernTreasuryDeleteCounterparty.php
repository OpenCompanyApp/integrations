<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete counterparty.
 *
 * Maps to the official Modern Treasury endpoint delete /api/counterparties/{id}.
 */
class ModernTreasuryDeleteCounterparty extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_counterparty';
    protected const DESCRIPTION = 'delete counterparty

Official Modern Treasury endpoint: DELETE /api/counterparties/{id}

Deletes a given counterparty.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
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
