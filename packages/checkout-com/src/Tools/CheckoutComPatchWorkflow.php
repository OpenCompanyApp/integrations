<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Patch a workflow.
 *
 * Maps to the official Checkout.com endpoint PATCH /workflows/{workflowId}.
 */
class CheckoutComPatchWorkflow extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_patch_workflow';
    protected const DESCRIPTION = 'Update a workflow.

Official Checkout.com endpoint: PATCH /workflows/{workflowId}.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/workflows/{workflowId}';
    protected const PATH_PARAMS = [
        'workflowId' => 'workflow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
