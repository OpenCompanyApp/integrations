<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve a sample for a Mistral voice.
 */
class MistralGetVoiceSample extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_voice_sample';
    protected const DESCRIPTION = 'Get the sample audio for a Mistral voice.';
    protected const PATH = '/v1/audio/voices/{voice_id}/sample';
    protected const PATH_PARAMS = ['voice_id'];
    protected const PARAMETERS = ['voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral voice ID.']];
}
