<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List documents for customer.
 *
 * Maps to the official Dwolla endpoint GET /customers/{id}/documents.
 */
class DwollaListCustomerDocuments extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_customer_documents';
    protected const DESCRIPTION = 'Returns all identity verification documents submitted for a customer. Includes document status, verification results, document type (passport, driver\'s license, etc.), and failure reasons if verification was rejected. Used to track document submission and verification progress during the business verification process.

Official Dwolla endpoint: GET /customers/{id}/documents.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/customers/{id}/documents';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
