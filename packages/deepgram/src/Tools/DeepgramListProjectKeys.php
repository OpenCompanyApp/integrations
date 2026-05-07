<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * List API keys for a Deepgram project.
 */
class DeepgramListProjectKeys extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_list_project_keys';
    protected const DESCRIPTION = 'List API keys associated with a Deepgram project.';
    protected const SERVICE_METHOD = 'listProjectKeys';
    protected const MODE = 'id_query';
    protected const ID_KEY = 'project_id';
    protected const QUERY_KEYS = ['status'];
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'status' => ['type' => 'string', 'enum' => ['active', 'expired'], 'description' => 'Only return keys with this status.'],
    ];
}
