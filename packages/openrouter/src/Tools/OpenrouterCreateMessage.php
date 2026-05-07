<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Create a message through OpenRouter's messages endpoint. */
class OpenrouterCreateMessage extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_create_message';
    protected const DESCRIPTION = 'Create a message through OpenRouter messages endpoint.';
    protected const METHOD = 'createMessage';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
