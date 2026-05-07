<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * delete expected payment.
 *
 * Maps to the official Modern Treasury endpoint delete /api/expected_payments/{id}.
 */
class ModernTreasuryDeleteExpectedPayment extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_delete_expected_payment';
    protected const DESCRIPTION = 'delete expected payment

Official Modern Treasury endpoint: DELETE /api/expected_payments/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'delete';
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
