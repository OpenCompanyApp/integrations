<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Remove a workflow condition.
 *
 * Maps to the official Checkout.com endpoint DELETE /workflows/{workflowId}/conditions/{workflowConditionId}.
 */
class CheckoutComRemoveWorkflowCondition extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_remove_workflow_condition';
    protected const DESCRIPTION = 'Removes a workflow condition. Conditions determine when the workflow will trigger.

Official Checkout.com endpoint: DELETE /workflows/{workflowId}/conditions/{workflowConditionId}.';
    protected const PARAMETERS = [
        'workflow_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The workflow identifier',
        ],
        'workflow_condition_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The workflow condition identifier',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/workflows/{workflowId}/conditions/{workflowConditionId}';
    protected const PATH_PARAMS = [
        'workflowId' => 'workflow_id',
        'workflowConditionId' => 'workflow_condition_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
