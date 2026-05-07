<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get a signed URL for a Mistral library document.
 */
class MistralGetLibraryDocumentSignedUrl extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_library_document_signed_url';
    protected const DESCRIPTION = 'Get a signed URL for a Mistral library document.';
    protected const PATH = '/v1/libraries/{library_id}/documents/{document_id}/signed-url';
    protected const PATH_PARAMS = ['library_id', 'document_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral document ID.']];
}
