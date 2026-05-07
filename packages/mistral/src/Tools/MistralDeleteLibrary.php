<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral library.
 */
class MistralDeleteLibrary extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_library';
    protected const DESCRIPTION = 'Delete a Mistral library.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/libraries/{library_id}';
    protected const PATH_PARAMS = ['library_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.']];
}
