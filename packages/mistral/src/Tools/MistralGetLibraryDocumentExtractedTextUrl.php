<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a signed URL for extracted text from a Mistral library document.
 */
class MistralGetLibraryDocumentExtractedTextUrl extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_library_document_extracted_text_url';
    protected const DESCRIPTION = 'Get a signed URL for extracted text from a Mistral library document.';
    protected const PATH = '/v1/libraries/{library_id}/documents/{document_id}/extracted-text-signed-url';
    protected const PATH_PARAMS = ['library_id', 'document_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral document ID.']];
}
