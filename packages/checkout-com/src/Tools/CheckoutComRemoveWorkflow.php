<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Remove a workflow.
 *
 * Maps to the official Checkout.com endpoint DELETE /workflows/{workflowId}.
 */
class CheckoutComRemoveWorkflow extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_remove_workflow';
    protected const DESCRIPTION = 'Removes a workflow so it is no longer being executed. Actions of already executed workflows will be still processed.

Official Checkout.com endpoint: DELETE /workflows/{workflowId}.';
    protected const PARAMETERS = [
        'workflow_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The workflow identifier',
        ],
    ];
    protected const METHOD = 'DELETE';
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
