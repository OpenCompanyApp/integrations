<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** List OpenRouter models that support embeddings. */
class OpenrouterListEmbeddingModels extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_list_embedding_models';
    protected const DESCRIPTION = 'List OpenRouter models that support embeddings.';
    protected const METHOD = 'listEmbeddingModels';
}
