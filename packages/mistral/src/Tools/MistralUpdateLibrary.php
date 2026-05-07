<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Update a Mistral library.
 */
class MistralUpdateLibrary extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_library';
    protected const DESCRIPTION = 'Update a Mistral library.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/libraries/{library_id}';
    protected const PATH_PARAMS = ['library_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Library update body matching the Mistral API schema.']];
}
