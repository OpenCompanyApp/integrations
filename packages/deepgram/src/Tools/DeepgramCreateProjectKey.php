<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Create an API key for a Deepgram project.
 */
class DeepgramCreateProjectKey extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_create_project_key';
    protected const DESCRIPTION = 'Create an API key for a Deepgram project. The body object must match the official key creation schema.';
    protected const SERVICE_METHOD = 'createProjectKey';
    protected const MODE = 'id_body';
    protected const ID_KEY = 'project_id';
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'API key settings such as scopes, tags, comment, or expiration_date.'],
    ];
}
