<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Initiate a mass payment.
 *
 * Maps to the official Dwolla endpoint POST /mass-payments.
 */
class DwollaInitiateMassPayment extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_initiate_mass_payment';
    protected const DESCRIPTION = 'Create a mass payment containing up to 5,000 individual payment items from a Dwolla Main Account or Verified Customer funding source. Supports optional metadata, correlation IDs for traceability, deferred processing, and expedited transfer options including same-day ACH clearing. Returns the location of the created mass payment resource with a unique identifier for tracking and management.

Official Dwolla endpoint: POST /mass-payments.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Idempotency-Key',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/mass-payments';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
        'Idempotency-Key' => 'idempotency_key',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
