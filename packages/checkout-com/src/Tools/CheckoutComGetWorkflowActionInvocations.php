<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get action invocations.
 *
 * Maps to the official Checkout.com endpoint GET /workflows/events/{eventId}/actions/{workflowActionId}.
 */
class CheckoutComGetWorkflowActionInvocations extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_workflow_action_invocations';
    protected const DESCRIPTION = 'Get the details of a workflow action executed for the specified event.

Official Checkout.com endpoint: GET /workflows/events/{eventId}/actions/{workflowActionId}.';
    protected const PARAMETERS = [
        'event_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The event identifier',
        ],
        'workflow_action_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The workflow action identifier',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/workflows/events/{eventId}/actions/{workflowActionId}';
    protected const PATH_PARAMS = [
        'eventId' => 'event_id',
        'workflowActionId' => 'workflow_action_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
