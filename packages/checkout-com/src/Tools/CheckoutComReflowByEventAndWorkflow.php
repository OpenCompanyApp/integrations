<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Reflow by event and workflow.
 *
 * Maps to the official Checkout.com endpoint POST /workflows/events/{eventId}/workflow/{workflowId}/reflow.
 */
class CheckoutComReflowByEventAndWorkflow extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_reflow_by_event_and_workflow';
    protected const DESCRIPTION = 'Reflows a past event by event ID and workflow ID. Triggers all the actions of a specific event and workflow combination if the event denoted by the event ID matches the workflow conditions.

Official Checkout.com endpoint: POST /workflows/events/{eventId}/workflow/{workflowId}/reflow.';
    protected const PARAMETERS = [
        'event_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique identifier for the event to be reflowed.',
        ],
        'workflow_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The identifier of the workflow whose actions you want to trigger.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/workflows/events/{eventId}/workflow/{workflowId}/reflow';
    protected const PATH_PARAMS = [
        'eventId' => 'event_id',
        'workflowId' => 'workflow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
