<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Get Deepgram project details.
 */
class DeepgramGetProject extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_get_project';
    protected const DESCRIPTION = 'Get Deepgram project details by project ID.';
    protected const SERVICE_METHOD = 'getProject';
    protected const MODE = 'id_query';
    protected const ID_KEY = 'project_id';
    protected const QUERY_KEYS = ['limit', 'page'];
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Results per page for endpoints that paginate project details.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
    ];
}
