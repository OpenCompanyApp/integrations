<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Add a workflow.
 *
 * Maps to the official Checkout.com endpoint POST /workflows.
 */
class CheckoutComAddWorkflow extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_add_workflow';
    protected const DESCRIPTION = 'Add a new workflow

Official Checkout.com endpoint: POST /workflows.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/workflows';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
