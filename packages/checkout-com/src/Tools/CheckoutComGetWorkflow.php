<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get a workflow.
 *
 * Maps to the official Checkout.com endpoint GET /workflows/{workflowId}.
 */
class CheckoutComGetWorkflow extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_workflow';
    protected const DESCRIPTION = 'Get the details of a workflow

Official Checkout.com endpoint: GET /workflows/{workflowId}.';
    protected const PARAMETERS = [
        'workflow_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The workflow identifier',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/workflows/{workflowId}';
    protected const PATH_PARAMS = [
        'workflowId' => 'workflow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
