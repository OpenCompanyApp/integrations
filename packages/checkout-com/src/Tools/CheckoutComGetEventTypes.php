<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get event types.
 *
 * Maps to the official Checkout.com endpoint GET /workflows/event-types.
 */
class CheckoutComGetEventTypes extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_event_types';
    protected const DESCRIPTION = 'Get a list of sources and their events for building new workflows

Official Checkout.com endpoint: GET /workflows/event-types.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/workflows/event-types';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
