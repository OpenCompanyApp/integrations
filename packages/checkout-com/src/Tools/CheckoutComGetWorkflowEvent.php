<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get an event.
 *
 * Maps to the official Checkout.com endpoint GET /workflows/events/{eventId}.
 */
class CheckoutComGetWorkflowEvent extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_workflow_event';
    protected const DESCRIPTION = 'Get the details of an event

Official Checkout.com endpoint: GET /workflows/events/{eventId}.';
    protected const PARAMETERS = [
        'event_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The event identifier',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/workflows/events/{eventId}';
    protected const PATH_PARAMS = [
        'eventId' => 'event_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
