<?php

namespace OpenCompany\Integrations\Deepgram\Tools;

/**
 * List public Deepgram models.
 */
class DeepgramListModels extends AbstractDeepgramTool
{
    protected const NAME = 'deepgram_list_models';
    protected const DESCRIPTION = 'List public Deepgram STT and TTS models. Set include_outdated=true to include non-latest versions.';
    protected const SERVICE_METHOD = 'listModels';
    protected const MODE = 'query';
    protected const QUERY_KEYS = ['include_outdated'];
    protected const PARAMETERS = [
        'include_outdated' => ['type' => 'boolean', 'description' => 'Return non-latest versions of models.'],
    ];
}
