<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Get one Deepgram project request.
 */
class DeepgramGetProjectRequest extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_get_project_request';
    protected const DESCRIPTION = 'Get a Deepgram project request by request ID.';
    protected const SERVICE_METHOD = 'getProjectRequest';
    protected const MODE = 'two_ids';
    protected const ID_KEY = 'project_id';
    protected const SECOND_ID_KEY = 'request_id';
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'request_id' => ['type' => 'string', 'required' => true, 'description' => 'Request ID.'],
    ];
}
