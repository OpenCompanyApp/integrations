<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Rerank documents.
 */
class FireworksAiRerankDocuments extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_rerank_documents';
    protected const DESCRIPTION = 'Rerank documents.';
    protected const METHOD = 'POST';
    protected const PATH = '/inference/v1/rerank';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
