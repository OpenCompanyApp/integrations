<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve extracted text for a Mistral library document.
 */
class MistralGetLibraryDocumentText extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_library_document_text';
    protected const DESCRIPTION = 'Get extracted text content for a Mistral library document.';
    protected const PATH = '/v1/libraries/{library_id}/documents/{document_id}/text_content';
    protected const PATH_PARAMS = ['library_id', 'document_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral document ID.']];
}
