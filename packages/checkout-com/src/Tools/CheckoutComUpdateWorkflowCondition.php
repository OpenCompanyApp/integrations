<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update a workflow condition.
 *
 * Maps to the official Checkout.com endpoint PUT /workflows/{workflowId}/conditions/{workflowConditionId}.
 */
class CheckoutComUpdateWorkflowCondition extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_workflow_condition';
    protected const DESCRIPTION = 'Update a workflow condition.

Official Checkout.com endpoint: PUT /workflows/{workflowId}/conditions/{workflowConditionId}.';
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
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/workflows/{workflowId}/conditions/{workflowConditionId}';
    protected const PATH_PARAMS = [
        'workflowId' => 'workflow_id',
        'workflowConditionId' => 'workflow_condition_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
