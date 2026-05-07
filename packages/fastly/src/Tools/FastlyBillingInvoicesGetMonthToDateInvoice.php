<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get month-to-date invoice.
 *
 * Maps to Fastly generated client operation BillingInvoicesApi::getMonthToDateInvoice (GET /billing/v3/invoices/month-to-date).
 */
class FastlyBillingInvoicesGetMonthToDateInvoice extends AbstractFastlyTool
{
    protected const NAME = 'fastly_billing_invoices_get_month_to_date_invoice';
    protected const DESCRIPTION = 'Get month-to-date invoice.

Official Fastly client operation: BillingInvoicesApi::getMonthToDateInvoice
Endpoint: GET /billing/v3/invoices/month-to-date

Get month-to-date invoice.';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_billing_invoices_get_month_to_date_invoice',
  'class' => 'FastlyBillingInvoicesGetMonthToDateInvoice',
  'api_class' => 'BillingInvoicesApi',
  'method_name' => 'getMonthToDateInvoice',
  'method' => 'GET',
  'path' => '/billing/v3/invoices/month-to-date',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get month-to-date invoice.',
  'description' => 'Get month-to-date invoice.',
  'type' => 'read',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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
