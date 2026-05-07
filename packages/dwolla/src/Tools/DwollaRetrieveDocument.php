<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve a document.
 *
 * Maps to the official Dwolla endpoint GET /documents/{id}.
 */
class DwollaRetrieveDocument extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_retrieve_document';
    protected const DESCRIPTION = 'Returns detailed information about a specific identity verification document, including its status, type, and verification results. Used to track document submission and verification progress during the business verification process.

Official Dwolla endpoint: GET /documents/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Document unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/documents/{id}';
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
