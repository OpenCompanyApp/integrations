<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List payments.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/payment/list.
 */
class PlaidPaymentInitiationPaymentList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_payment_list';
    protected const DESCRIPTION = 'List payments

Official Plaid endpoint: POST /payment_initiation/payment/list

The `/payment_initiation/payment/list` endpoint can be used to retrieve all created payments. By default, the 10 most recent payments are returned. You can request more payments and paginate through the results using the optional `count` and `cursor` parameters.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/payment/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}