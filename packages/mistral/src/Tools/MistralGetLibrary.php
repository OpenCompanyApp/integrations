<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve a Mistral library.
 */
class MistralGetLibrary extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_library';
    protected const DESCRIPTION = 'Get a Mistral library by library_id.';
    protected const PATH = '/v1/libraries/{library_id}';
    protected const PATH_PARAMS = ['library_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.']];
}
