<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get expected payment.
 *
 * Maps to the official Modern Treasury endpoint get /api/expected_payments/{id}.
 */
class ModernTreasuryGetExpectedPayment extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_expected_payment';
    protected const DESCRIPTION = 'get expected payment

Official Modern Treasury endpoint: GET /api/expected_payments/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/expected_payments/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
