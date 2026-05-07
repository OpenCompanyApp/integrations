<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update invoice.
 *
 * Maps to the official Modern Treasury endpoint patch /api/invoices/{id}.
 */
class ModernTreasuryUpdateInvoice extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_invoice';
    protected const DESCRIPTION = 'update invoice

Official Modern Treasury endpoint: PATCH /api/invoices/{id}';
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
