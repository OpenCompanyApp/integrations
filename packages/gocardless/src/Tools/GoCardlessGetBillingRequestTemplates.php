<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single Billing Request Template.
 *
 * Maps to the official GoCardless endpoint GET /billing_request_templates/{billing_request_template_id}.
 */
class GoCardlessGetBillingRequestTemplates extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_billing_request_templates';
    protected const DESCRIPTION = 'Fetches a Billing Request Template

Official GoCardless endpoint: GET /billing_request_templates/{billing_request_template_id}.';
    protected const PARAMETERS = [
        'billing_request_template_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The billing request template id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/billing_request_templates/{billing_request_template_id}';
    protected const PATH_PARAMS = [
        'billing_request_template_id' => 'billing_request_template_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
