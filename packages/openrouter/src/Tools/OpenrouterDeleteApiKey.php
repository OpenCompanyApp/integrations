<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Delete an OpenRouter API key by hash. */
class OpenrouterDeleteApiKey extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_delete_api_key';
    protected const DESCRIPTION = 'Delete an OpenRouter API key by hash.';
    protected const METHOD = 'deleteApiKey';
    protected const ARGUMENTS = ['hash'];
    protected const REQUIRED = ['hash'];
}
