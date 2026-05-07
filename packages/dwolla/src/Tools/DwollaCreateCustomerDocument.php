<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create a document for customer.
 *
 * Maps to the official Dwolla endpoint POST /customers/{id}/documents.
 */
class DwollaCreateCustomerDocument extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_customer_document';
    protected const DESCRIPTION = 'Uploads an identity verification document for a customer using multipart form-data. Required when a customer has "document" status during the verification process.

Official Dwolla endpoint: POST /customers/{id}/documents.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'customer unique identifier',
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
    protected const PATH = '/customers/{id}/documents';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'multipart/form-data';
    protected const AUTH_MODE = 'bearer';
}
