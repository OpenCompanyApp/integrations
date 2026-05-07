<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete sharing from a Mistral library.
 */
class MistralDeleteLibraryShare extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_library_share';
    protected const DESCRIPTION = 'Delete sharing from a Mistral library.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/libraries/{library_id}/share';
    protected const PATH_PARAMS = ['library_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Share delete body matching the Mistral API schema.']];
}
