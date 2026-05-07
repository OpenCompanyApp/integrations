<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get payment_reference.
 *
 * Maps to the official Modern Treasury endpoint get /api/payment_references/{id}.
 */
class ModernTreasuryGetPaymentReference extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_payment_reference';
    protected const DESCRIPTION = 'get payment_reference

Official Modern Treasury endpoint: GET /api/payment_references/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/payment_references/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
