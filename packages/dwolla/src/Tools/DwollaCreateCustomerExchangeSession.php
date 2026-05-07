<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create customer exchange session.
 *
 * Maps to the official Dwolla endpoint POST /customers/{id}/exchange-sessions.
 */
class DwollaCreateCustomerExchangeSession extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_customer_exchange_session';
    protected const DESCRIPTION = 'Creates an exchange session for a customer. Use cases include: - **Plaid / MX**: Instant bank account verification (open banking). For faster verification as compared to traditional micro-deposits. - **Checkout.com**: Debit card capture for Push to Card. Create a session, then retrieve it to get `externalProviderSessionData` (payment session) for the Checkout.com Flow component.

Official Dwolla endpoint: POST /customers/{id}/exchange-sessions.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Customer\'s unique identifier',
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
    protected const PATH = '/customers/{id}/exchange-sessions';
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
