<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral voices.
 */
class MistralListVoices extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_voices';
    protected const DESCRIPTION = 'List Mistral audio voices.';
    protected const PATH = '/v1/audio/voices';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional voice list query parameters.']];
}
