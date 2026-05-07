<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * list invoice_line_items.
 *
 * Maps to the official Modern Treasury endpoint get /api/invoices/{invoice_id}/invoice_line_items.
 */
class ModernTreasuryListInvoiceLineItems extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_list_invoice_line_items';
    protected const DESCRIPTION = 'list invoice_line_items

Official Modern Treasury endpoint: GET /api/invoices/{invoice_id}/invoice_line_items';
    protected const PARAMETERS = array (
  'invoice_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `invoice_id` from the official Modern Treasury API operation.',
  ),
  'after_cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after_cursor` from the official Modern Treasury API operation.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `per_page` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/invoices/{invoice_id}/invoice_line_items';
    protected const PATH_PARAMS = array (
  'invoice_id' => 'invoice_id',
);
    protected const QUERY_PARAMS = array (
  'after_cursor' => 'after_cursor',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
