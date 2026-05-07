<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve a Mistral library document.
 */
class MistralGetLibraryDocument extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_library_document';
    protected const DESCRIPTION = 'Get a document in a Mistral library.';
    protected const PATH = '/v1/libraries/{library_id}/documents/{document_id}';
    protected const PATH_PARAMS = ['library_id', 'document_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library document ID.']];
}
