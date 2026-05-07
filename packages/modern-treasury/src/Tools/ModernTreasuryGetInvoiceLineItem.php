<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get invoice_line_item.
 *
 * Maps to the official Modern Treasury endpoint get /api/invoices/{invoice_id}/invoice_line_items/{id}.
 */
class ModernTreasuryGetInvoiceLineItem extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_invoice_line_item';
    protected const DESCRIPTION = 'get invoice_line_item

Official Modern Treasury endpoint: GET /api/invoices/{invoice_id}/invoice_line_items/{id}';
    protected const PARAMETERS = array (
  'invoice_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `invoice_id` from the official Modern Treasury API operation.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/invoices/{invoice_id}/invoice_line_items/{id}';
    protected const PATH_PARAMS = array (
  'invoice_id' => 'invoice_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
