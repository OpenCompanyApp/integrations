<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Reflow by event.
 *
 * Maps to the official Checkout.com endpoint POST /workflows/events/{eventId}/reflow.
 */
class CheckoutComReflowByEvent extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_reflow_by_event';
    protected const DESCRIPTION = 'Reflows a past event denoted by the event ID and triggers the actions of any workflows with matching conditions.

Official Checkout.com endpoint: POST /workflows/events/{eventId}/reflow.';
    protected const PARAMETERS = [
        'event_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique identifier for the event to be reflowed.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/workflows/events/{eventId}/reflow';
    protected const PATH_PARAMS = [
        'eventId' => 'event_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
