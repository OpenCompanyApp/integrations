<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Get project-specific Deepgram model metadata.
 */
class DeepgramGetProjectModel extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_get_project_model';
    protected const DESCRIPTION = 'Get metadata for a Deepgram model available to a specific project, including private models.';
    protected const SERVICE_METHOD = 'getProjectModel';
    protected const MODE = 'two_ids';
    protected const ID_KEY = 'project_id';
    protected const SECOND_ID_KEY = 'model_id';
    protected const PARAMETERS = [
        'project_id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID.'],
        'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Model UUID or model ID.'],
    ];
}
