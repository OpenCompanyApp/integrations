<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * List models available to a Deepgram project.
 */
class DeepgramListProjectModels extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_list_project_models';
    protected const DESCRIPTION = 'List public and private Deepgram models available to a project.';
    protected const SERVICE_METHOD = 'listProjectModels';
    protected const MODE = 'id_query';
    protected const ID_KEY = 'project_id';
    protected const QUERY_KEYS = ['include_outdated'];
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'include_outdated' => ['type' => 'boolean', 'description' => 'Return non-latest versions of models.'],
    ];
}
