<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Remove a workflow action.
 *
 * Maps to the official Checkout.com endpoint DELETE /workflows/{workflowId}/actions/{workflowActionId}.
 */
class CheckoutComRemoveWorkflowAction extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_remove_workflow_action';
    protected const DESCRIPTION = 'Removes a workflow action. Actions determine what the workflow will do when it is triggered.

Official Checkout.com endpoint: DELETE /workflows/{workflowId}/actions/{workflowActionId}.';
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
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/workflows/{workflowId}/actions/{workflowActionId}';
    protected const PATH_PARAMS = [
        'workflowId' => 'workflow_id',
        'workflowActionId' => 'workflow_action_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
