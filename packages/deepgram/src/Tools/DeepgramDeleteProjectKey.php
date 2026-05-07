<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Delete an API key from a Deepgram project.
 */
class DeepgramDeleteProjectKey extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_delete_project_key';
    protected const DESCRIPTION = 'Delete an API key from a Deepgram project.';
    protected const SERVICE_METHOD = 'deleteProjectKey';
    protected const MODE = 'two_ids';
    protected const ID_KEY = 'project_id';
    protected const SECOND_ID_KEY = 'key_id';
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'key_id' => ['type' => 'string', 'required' => true, 'description' => 'API key ID to delete.'],
    ];
}
