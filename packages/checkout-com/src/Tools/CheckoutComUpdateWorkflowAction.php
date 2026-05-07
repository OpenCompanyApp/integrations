<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update a workflow action.
 *
 * Maps to the official Checkout.com endpoint PUT /workflows/{workflowId}/actions/{workflowActionId}.
 */
class CheckoutComUpdateWorkflowAction extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_workflow_action';
    protected const DESCRIPTION = 'Update a workflow action.

Official Checkout.com endpoint: PUT /workflows/{workflowId}/actions/{workflowActionId}.';
    protected const PARAMETERS = [
        'workflow_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The workflow identifier',
        ],
        'workflow_action_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The workflow action identifier',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/workflows/{workflowId}/actions/{workflowActionId}';
    protected const PATH_PARAMS = [
        'workflowId' => 'workflow_id',
        'workflowActionId' => 'workflow_action_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
