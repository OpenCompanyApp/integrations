<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve a Mistral voice.
 */
class MistralGetVoice extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_voice';
    protected const DESCRIPTION = 'Get a Mistral voice by voice_id.';
    protected const PATH = '/v1/audio/voices/{voice_id}';
    protected const PATH_PARAMS = ['voice_id'];
    protected const PARAMETERS = ['voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral voice ID.']];
}
