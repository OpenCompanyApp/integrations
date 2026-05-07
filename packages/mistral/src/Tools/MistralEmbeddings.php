<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create embeddings with Mistral.
 */
class MistralEmbeddings extends AbstractMistralTool
{
    protected const NAME = 'mistral_embeddings';
    protected const DESCRIPTION = 'Create embeddings using /v1/embeddings.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/embeddings';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Embeddings body with model and input.']];
}
