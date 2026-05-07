<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve mass payment item.
 *
 * Maps to the official Dwolla endpoint GET /mass-payment-items/{itemId}.
 */
class DwollaGetMassPaymentItem extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_mass_payment_item';
    protected const DESCRIPTION = 'Retrieve detailed information for a specific mass payment item by its unique identifier. Returns item status, amount, metadata, and links to the parent mass payment, associated transfer, and destination funding source. Use this endpoint to check the processing status and details of an individual item within a mass payment batch.

Official Dwolla endpoint: GET /mass-payment-items/{itemId}.';
    protected const PARAMETERS = [
        'item_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of item to be retrieved in mass payment',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/mass-payment-items/{itemId}';
    protected const PATH_PARAMS = [
        'itemId' => 'item_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
