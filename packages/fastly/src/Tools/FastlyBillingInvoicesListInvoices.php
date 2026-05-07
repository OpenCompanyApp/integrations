<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List of invoices.
 *
 * Maps to Fastly generated client operation BillingInvoicesApi::listInvoices (GET /billing/v3/invoices).
 */
class FastlyBillingInvoicesListInvoices extends AbstractFastlyTool
{
    protected const NAME = 'fastly_billing_invoices_list_invoices';
    protected const DESCRIPTION = 'List of invoices.

Official Fastly client operation: BillingInvoicesApi::listInvoices
Endpoint: GET /billing/v3/invoices

List of invoices.';
    protected const PARAMETERS = array (
  'billing_start_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `billing_start_date`.',
  ),
  'billing_end_date' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `billing_end_date`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_billing_invoices_list_invoices',
  'class' => 'FastlyBillingInvoicesListInvoices',
  'api_class' => 'BillingInvoicesApi',
  'method_name' => 'listInvoices',
  'method' => 'GET',
  'path' => '/billing/v3/invoices',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List of invoices.',
  'description' => 'List of invoices.',
  'type' => 'read',
  'parameters' =>
  array (
    'billing_start_date' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `billing_start_date`.',
    ),
    'billing_end_date' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `billing_end_date`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'billing_start_date' => 'billing_start_date',
    'billing_end_date' => 'billing_end_date',
    'limit' => 'limit',
    'cursor' => 'cursor',
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
