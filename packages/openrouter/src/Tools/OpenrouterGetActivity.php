<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Get OpenRouter user activity grouped by endpoint. */
class OpenrouterGetActivity extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_get_activity';
    protected const DESCRIPTION = 'Get OpenRouter user activity grouped by endpoint.';
    protected const METHOD = 'getActivity';
    protected const USE_QUERY = true;
}
