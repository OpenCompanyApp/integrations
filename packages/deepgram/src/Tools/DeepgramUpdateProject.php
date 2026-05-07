<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Update Deepgram project settings.
 */
class DeepgramUpdateProject extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_update_project';
    protected const DESCRIPTION = 'Update Deepgram project settings such as name. The body object must match the official project update schema.';
    protected const SERVICE_METHOD = 'updateProject';
    protected const MODE = 'id_body';
    protected const ID_KEY = 'project_id';
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Project update body, for example { "name": "New name" }.'],
    ];
}
