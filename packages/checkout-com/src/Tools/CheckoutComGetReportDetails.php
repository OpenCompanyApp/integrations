<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get report details.
 *
 * Maps to the official Checkout.com endpoint GET /reports/{id}.
 */
class CheckoutComGetReportDetails extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_report_details';
    protected const DESCRIPTION = 'Use this endpoint to retrieve a specific report using its ID.

Official Checkout.com endpoint: GET /reports/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the report to retrieve.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/reports/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
