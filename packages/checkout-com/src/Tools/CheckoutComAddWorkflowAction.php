<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Add a workflow action.
 *
 * Maps to the official Checkout.com endpoint POST /workflows/{workflowId}/actions.
 */
class CheckoutComAddWorkflowAction extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_add_workflow_action';
    protected const DESCRIPTION = 'Adds a workflow action. Actions determine what the workflow will do when it is triggered.

Official Checkout.com endpoint: POST /workflows/{workflowId}/actions.';
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
    protected const PATH = '/workflows/{workflowId}/actions';
    protected const PATH_PARAMS = [
        'workflowId' => 'workflow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
