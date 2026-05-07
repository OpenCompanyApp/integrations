<?php

namespace OpenCompany\Integrations\Lever\Tools;

/**
 * Submit an authenticated Data API application to a posting.
 */
class LeverApplyDataPosting extends AbstractLeverDataTool
{
    protected const TOOL_NAME = 'lever_apply_data_posting';
    protected const TOOL_DESCRIPTION = 'Submit an application to a Lever posting through the authenticated Data API. Official Lever Data API endpoint: POST /postings/{posting}/apply.';
    protected const METHOD = 'POST';
    protected const PATH = '/postings/{posting}/apply';
    protected const PATH_KEYS = ['posting'];
    protected const QUERY_KEYS = ['distribution', 'send_confirmation_email', 'perform_as'];
    protected const PARAMETERS = [
        'posting' => ['type' => 'string', 'required' => true, 'description' => 'Lever posting identifier.'],
        'distribution' => ['type' => 'string', 'required' => false, 'description' => 'Posting distribution such as internal.'],
        'send_confirmation_email' => ['type' => 'boolean', 'required' => false, 'description' => 'Ask Lever to send the application confirmation email.'],
        'perform_as' => ['type' => 'string', 'required' => false, 'description' => 'Lever user ID to perform the request as when required.'],
        'params' => ['type' => 'object', 'required' => false, 'description' => 'Additional Lever query parameters.'],
        'payload' => ['type' => 'object', 'required' => false, 'description' => 'JSON application body accepted by the Lever Data API.'],
    ];
}
