<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Reprocess a Mistral library document.
 */
class MistralReprocessLibraryDocument extends AbstractMistralTool
{
    protected const NAME = 'mistral_reprocess_library_document';
    protected const DESCRIPTION = 'Reprocess a Mistral library document.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/libraries/{library_id}/documents/{document_id}/reprocess';
    protected const PATH_PARAMS = ['library_id', 'document_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral document ID.']];
}
