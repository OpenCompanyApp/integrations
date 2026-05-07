<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Reflow by subject and workflow.
 *
 * Maps to the official Checkout.com endpoint POST /workflows/events/subject/{subjectId}/workflow/{workflowId}/reflow.
 */
class CheckoutComReflowBySubjectAndWorkflow extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_reflow_by_subject_and_workflow';
    protected const DESCRIPTION = 'Reflows the events associated with a subject ID (for example, a payment ID or a dispute ID) and triggers the actions of the specified workflow if the conditions match.

Official Checkout.com endpoint: POST /workflows/events/subject/{subjectId}/workflow/{workflowId}/reflow.';
    protected const PARAMETERS = [
        'subject_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The subject identifier (for example, a payment ID or a dispute ID). The events associated with these subjects will be reflowed.',
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
    protected const PATH = '/workflows/events/subject/{subjectId}/workflow/{workflowId}/reflow';
    protected const PATH_PARAMS = [
        'subjectId' => 'subject_id',
        'workflowId' => 'workflow_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
