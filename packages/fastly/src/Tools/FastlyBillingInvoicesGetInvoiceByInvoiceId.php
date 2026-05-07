<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get invoice by ID.
 *
 * Maps to Fastly generated client operation BillingInvoicesApi::getInvoiceByInvoiceId (GET /billing/v3/invoices/{invoice_id}).
 */
class FastlyBillingInvoicesGetInvoiceByInvoiceId extends AbstractFastlyTool
{
    protected const NAME = 'fastly_billing_invoices_get_invoice_by_invoice_id';
    protected const DESCRIPTION = 'Get invoice by ID.

Official Fastly client operation: BillingInvoicesApi::getInvoiceByInvoiceId
Endpoint: GET /billing/v3/invoices/{invoice_id}

Get invoice by ID.';
    protected const PARAMETERS = array (
  'invoice_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `invoice_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_billing_invoices_get_invoice_by_invoice_id',
  'class' => 'FastlyBillingInvoicesGetInvoiceByInvoiceId',
  'api_class' => 'BillingInvoicesApi',
  'method_name' => 'getInvoiceByInvoiceId',
  'method' => 'GET',
  'path' => '/billing/v3/invoices/{invoice_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get invoice by ID.',
  'description' => 'Get invoice by ID.',
  'type' => 'read',
  'parameters' =>
  array (
    'invoice_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `invoice_id`.',
    ),
  ),
  'path_params' =>
  array (
    'invoice_id' => 'invoice_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
