<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * List institutions for Billing Request.
 *
 * Maps to the official GoCardless endpoint GET /billing_requests/{billing_request_id}/institutions.
 */
class GoCardlessGetInstitutionsFromInstitution extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_institutions_from_institution';
    protected const DESCRIPTION = 'Returns all institutions valid for a Billing Request. This endpoint is currently supported only for FasterPayments.

Official GoCardless endpoint: GET /billing_requests/{billing_request_id}/institutions.';
    protected const PARAMETERS = [
        'billing_request_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The billing request id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/billing_requests/{billing_request_id}/institutions';
    protected const PATH_PARAMS = [
        'billing_request_id' => 'billing_request_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
