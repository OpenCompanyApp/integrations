<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get report file.
 *
 * Maps to the official Checkout.com endpoint GET /reports/{id}/files/{fileId}.
 */
class CheckoutComGetReportFile extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_report_file';
    protected const DESCRIPTION = 'Use this endpoint to retrieve a specific file from a given report using their respective IDs.

Official Checkout.com endpoint: GET /reports/{id}/files/{fileId}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the report that the file belongs to.',
        ],
        'file_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the file to retrieve.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/reports/{id}/files/{fileId}';
    protected const PATH_PARAMS = [
        'id' => 'id',
        'fileId' => 'file_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
