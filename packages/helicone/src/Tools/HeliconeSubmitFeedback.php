<?php

namespace OpenCompany\Integrations\Helicone\Tools;

/**
 * Submit user feedback for a Helicone request.
 */
class HeliconeSubmitFeedback extends AbstractHeliconeTool
{
    protected const NAME = 'helicone_submit_feedback';
    protected const DESCRIPTION = 'Submit positive or negative user feedback for a Helicone request. Body should usually contain rating boolean.';
    protected const SERVICE_METHOD = 'submitFeedback';
    protected const MODE = 'id_body';
    protected const ID_KEY = 'request_id';
    protected const PARAMETERS = [
        'request_id' => ['type' => 'string', 'required' => true, 'description' => 'Helicone request ID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Feedback body, usually { "rating": true } or { "rating": false }.'],
    ];
}
