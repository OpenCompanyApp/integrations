<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create an exchange for a customer.
 *
 * Maps to the official Dwolla endpoint POST /customers/{id}/exchanges.
 */
class DwollaCreateCustomerExchange extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_customer_exchange';
    protected const DESCRIPTION = 'Creates an exchange connection between a customer and Dwolla. Request body varies by partner (Plaid, MX, Flinks, Finicity, Checkout.com). For bank accounts, use Plaid, MX, Flinks, or Finicity to establish secure access to the customer\'s bank account data. For debit cards (Push to Card), use Checkout.com and pass the payment ID from Checkout.com Flow.

Official Dwolla endpoint: POST /customers/{id}/exchanges.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the customer to create an exchange for',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/customers/{id}/exchanges';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/vnd.dwolla.v1.hal+json';
    protected const AUTH_MODE = 'bearer';
}
