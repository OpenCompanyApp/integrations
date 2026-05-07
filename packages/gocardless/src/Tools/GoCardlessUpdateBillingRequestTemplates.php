<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a Billing Request Template.
 *
 * Maps to the official GoCardless endpoint PUT /billing_request_templates/{billing_request_template_id}.
 */
class GoCardlessUpdateBillingRequestTemplates extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_billing_request_templates';
    protected const DESCRIPTION = 'Updates a Billing Request Template, which will affect all future Billing Requests created by this template.

Official GoCardless endpoint: PUT /billing_request_templates/{billing_request_template_id}.';
    protected const PARAMETERS = [
        'billing_request_template_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The billing request template id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GoCardless OpenAPI schema.',
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/billing_request_templates/{billing_request_template_id}';
    protected const PATH_PARAMS = [
        'billing_request_template_id' => 'billing_request_template_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
