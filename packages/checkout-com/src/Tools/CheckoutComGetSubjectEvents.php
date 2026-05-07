<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get subject events.
 *
 * Maps to the official Checkout.com endpoint GET /workflows/events/subject/{subjectId}.
 */
class CheckoutComGetSubjectEvents extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_subject_events';
    protected const DESCRIPTION = 'Get all events that relate to a specific subject

Official Checkout.com endpoint: GET /workflows/events/subject/{subjectId}.';
    protected const PARAMETERS = [
        'subject_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The event identifier',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/workflows/events/subject/{subjectId}';
    protected const PATH_PARAMS = [
        'subjectId' => 'subject_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
