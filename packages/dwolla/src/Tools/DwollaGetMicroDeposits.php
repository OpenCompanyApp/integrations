<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve micro-deposits details.
 *
 * Maps to the official Dwolla endpoint GET /funding-sources/{id}/micro-deposits.
 */
class DwollaGetMicroDeposits extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_micro_deposits';
    protected const DESCRIPTION = 'Returns the status and details of micro-deposits for a funding source to check verification eligibility. Includes deposit status (pending, processed, failed), creation timestamp, and failure details with ACH return codes if deposits failed. Use this endpoint to determine when micro-deposits are ready for verification.

Official Dwolla endpoint: GET /funding-sources/{id}/micro-deposits.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the FS that previously had micro-deposits initiated',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/funding-sources/{id}/micro-deposits';
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
