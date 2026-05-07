<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get invoice.
 *
 * Maps to the official Modern Treasury endpoint get /api/invoices/{id}.
 */
class ModernTreasuryGetInvoice extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_invoice';
    protected const DESCRIPTION = 'get invoice

Official Modern Treasury endpoint: GET /api/invoices/{id}';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/invoices/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
