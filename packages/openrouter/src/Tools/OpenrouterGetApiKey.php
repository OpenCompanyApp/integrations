<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Get one OpenRouter API key by hash. */
class OpenrouterGetApiKey extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_get_api_key';
    protected const DESCRIPTION = 'Get one OpenRouter API key by hash.';
    protected const METHOD = 'getApiKey';
    protected const ARGUMENTS = ['hash'];
    protected const REQUIRED = ['hash'];
}
