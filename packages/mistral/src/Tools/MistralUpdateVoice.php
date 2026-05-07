<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Update a Mistral voice.
 */
class MistralUpdateVoice extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_voice';
    protected const DESCRIPTION = 'Patch a Mistral voice by voice_id.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/audio/voices/{voice_id}';
    protected const PATH_PARAMS = ['voice_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral voice ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Voice update body matching the Mistral API schema.']];
}
