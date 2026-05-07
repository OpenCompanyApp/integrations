<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral voice.
 */
class MistralDeleteVoice extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_voice';
    protected const DESCRIPTION = 'Delete a Mistral voice by voice_id.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/audio/voices/{voice_id}';
    protected const PATH_PARAMS = ['voice_id'];
    protected const PARAMETERS = ['voice_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral voice ID.']];
}
