<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Call a safe relative OpenRouter PATCH path. */
class OpenrouterApiPatch extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_api_patch';
    protected const DESCRIPTION = 'Call a safe relative OpenRouter PATCH path for endpoints not covered by first-class tools.';
    protected const METHOD = 'apiPatch';
    protected const ARGUMENTS = ['path'];
    protected const REQUIRED = ['path'];
    protected const USE_PAYLOAD = true;
}
