<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Create a response through OpenRouter's Responses-compatible endpoint. */
class OpenrouterCreateResponse extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_create_response';
    protected const DESCRIPTION = 'Create a response through OpenRouter responses endpoint.';
    protected const METHOD = 'createResponse';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
