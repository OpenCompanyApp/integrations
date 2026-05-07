<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Submit an OpenRouter embedding request. */
class OpenrouterCreateEmbedding extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_create_embedding';
    protected const DESCRIPTION = 'Submit an embedding request through OpenRouter.';
    protected const METHOD = 'createEmbedding';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
