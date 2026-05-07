<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Cancel a transfer.
 *
 * Maps to the official Dwolla endpoint POST /transfers/{id}.
 */
class DwollaCancelTransfer extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_cancel_transfer';
    protected const DESCRIPTION = 'Cancel a pending transfer by setting its status to cancelled. Only transfers in pending status can be cancelled before processing begins. Returns the updated transfer resource with cancelled status. Use this endpoint to stop a bank transfer from further processing.

Official Dwolla endpoint: POST /transfers/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of transfer',
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
    protected const PATH = '/transfers/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
