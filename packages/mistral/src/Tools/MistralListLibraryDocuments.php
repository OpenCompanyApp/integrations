<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List documents in a Mistral library.
 */
class MistralListLibraryDocuments extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_library_documents';
    protected const DESCRIPTION = 'List documents in a Mistral library.';
    protected const PATH = '/v1/libraries/{library_id}/documents';
    protected const PATH_PARAMS = ['library_id'];
    protected const PARAMETERS = ['library_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral library ID.'], 'query' => ['type' => 'object', 'description' => 'Optional document list query parameters.']];
}
