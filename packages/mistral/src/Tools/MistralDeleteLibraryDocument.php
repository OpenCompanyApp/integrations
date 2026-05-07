<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Delete a Mistral library document.
 */
class MistralDeleteLibraryDocument extends AbstractMistralTool
{
    protected const NAME = 'mistral_delete_library_document';
    protected const DESCRIPTION = 'Delete a document from a Mistral library.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/libraries/{library_id}/documents/{document_id}';
    protected const PATH_PARAMS = ['library_id', 'document_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral document ID.']];
}
