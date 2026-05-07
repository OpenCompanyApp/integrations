<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Reflow by subject.
 *
 * Maps to the official Checkout.com endpoint POST /workflows/events/subject/{subjectId}/reflow.
 */
class CheckoutComReflowBySubject extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_reflow_by_subject';
    protected const DESCRIPTION = 'Reflows the events associated with a subject ID (for example, a payment ID or a dispute ID) and triggers the actions of any workflows with matching conditions.

Official Checkout.com endpoint: POST /workflows/events/subject/{subjectId}/reflow.';
    protected const PARAMETERS = [
        'subject_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The subject identifier (for example, a payment ID or a dispute ID). The events associated with these subjects will be reflowed.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/workflows/events/subject/{subjectId}/reflow';
    protected const PATH_PARAMS = [
        'subjectId' => 'subject_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
