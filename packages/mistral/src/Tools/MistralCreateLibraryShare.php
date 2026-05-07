<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create or update sharing for a Mistral library.
 */
class MistralCreateLibraryShare extends AbstractMistralTool
{
    protected const NAME = 'mistral_create_library_share';
    protected const DESCRIPTION = 'Create or update sharing for a Mistral library.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/libraries/{library_id}/share';
    protected const PATH_PARAMS = ['library_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Share body matching the Mistral API schema.']];
}
