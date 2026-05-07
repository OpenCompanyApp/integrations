<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Call a safe relative OpenRouter DELETE path. */
class OpenrouterApiDelete extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_api_delete';
    protected const DESCRIPTION = 'Call a safe relative OpenRouter DELETE path for endpoints not covered by first-class tools.';
    protected const METHOD = 'apiDelete';
    protected const ARGUMENTS = ['path'];
    protected const REQUIRED = ['path'];
    protected const USE_QUERY = true;
}
