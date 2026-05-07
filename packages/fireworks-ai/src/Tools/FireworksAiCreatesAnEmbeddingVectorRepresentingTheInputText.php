<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Create embeddings.
 */
class FireworksAiCreatesAnEmbeddingVectorRepresentingTheInputText extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_create_embeddings';
    protected const DESCRIPTION = 'Create embeddings.';
    protected const METHOD = 'POST';
    protected const PATH = '/inference/v1/embeddings';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
