<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Submit a rerank request through OpenRouter. */
class OpenrouterRerank extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_rerank';
    protected const DESCRIPTION = 'Submit a rerank request through OpenRouter.';
    protected const METHOD = 'rerank';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
