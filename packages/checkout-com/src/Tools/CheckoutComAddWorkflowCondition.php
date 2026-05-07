<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Add a workflow condition.
 *
 * Maps to the official Checkout.com endpoint POST /workflows/{workflowId}/conditions.
 */
class CheckoutComAddWorkflowCondition extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_add_workflow_condition';
    protected const DESCRIPTION = 'Adds a workflow condition. Conditions determine when the workflow will trigger.

Official Checkout.com endpoint: POST /workflows/{workflowId}/conditions.';
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
    protected const PATH = '/workflows/{workflowId}/conditions';
    protected const PATH_PARAMS = [
        'workflowId' => 'workflow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
