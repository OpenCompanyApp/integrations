<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * Get public Deepgram model metadata.
 */
class DeepgramGetModel extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_get_model';
    protected const DESCRIPTION = 'Get metadata for a specific public Deepgram model.';
    protected const SERVICE_METHOD = 'getModel';
    protected const MODE = 'id';
    protected const ID_KEY = 'model_id';
    protected const PARAMETERS = [
        'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Model UUID or model ID.'],
    ];
}
