<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Update a Mistral library document.
 */
class MistralUpdateLibraryDocument extends AbstractMistralTool
{
    protected const NAME = 'mistral_update_library_document';
    protected const DESCRIPTION = 'Update metadata for a Mistral library document.';
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/libraries/{library_id}/documents/{document_id}';
    protected const PATH_PARAMS = ['library_id', 'document_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral document ID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Document update body matching the Mistral API schema.']];
}
