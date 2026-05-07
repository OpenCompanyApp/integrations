<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Reflow.
 *
 * Maps to the official Checkout.com endpoint POST /workflows/events/reflow.
 */
class CheckoutComReflowEvents extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_reflow_events';
    protected const DESCRIPTION = 'Reflow past events attached to multiple event IDs and workflow IDs, or to multiple subject IDs and workflow IDs. If you don\'t specify any workflow IDs, all matching workflows will be retriggered.

Official Checkout.com endpoint: POST /workflows/events/reflow.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/workflows/events/reflow';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
