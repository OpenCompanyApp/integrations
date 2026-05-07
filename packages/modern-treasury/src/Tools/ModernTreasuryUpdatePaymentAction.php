<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update payment_action.
 *
 * Maps to the official Modern Treasury endpoint patch /api/payment_actions/{id}.
 */
class ModernTreasuryUpdatePaymentAction extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_payment_action';
    protected const DESCRIPTION = 'update payment_action

Official Modern Treasury endpoint: PATCH /api/payment_actions/{id}

Update a single payment action.';
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
    protected const PATH = '/api/payment_actions/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
