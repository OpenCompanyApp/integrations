<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve processing status for a Mistral library document.
 */
class MistralGetLibraryDocumentStatus extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_library_document_status';
    protected const DESCRIPTION = 'Get processing status for a Mistral library document.';
    protected const PATH = '/v1/libraries/{library_id}/documents/{document_id}/status';
    protected const PATH_PARAMS = ['library_id', 'document_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral document ID.']];
}
