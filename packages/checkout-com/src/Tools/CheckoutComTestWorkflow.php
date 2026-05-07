<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Test a workflow.
 *
 * Maps to the official Checkout.com endpoint POST /workflows/{workflowId}/test.
 */
class CheckoutComTestWorkflow extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_test_workflow';
    protected const DESCRIPTION = 'Validate a workflow in our Sandbox environment.

Official Checkout.com endpoint: POST /workflows/{workflowId}/test.';
    protected const PARAMETERS = [
        'workflow_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The workflow identifier',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/workflows/{workflowId}/test';
    protected const PATH_PARAMS = [
        'workflowId' => 'workflow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
