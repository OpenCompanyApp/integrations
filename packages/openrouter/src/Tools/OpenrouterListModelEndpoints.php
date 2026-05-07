<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** List all endpoints for a specific OpenRouter model. */
class OpenrouterListModelEndpoints extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_list_model_endpoints';
    protected const DESCRIPTION = 'List all endpoints available for a specific OpenRouter model.';
    protected const METHOD = 'listModelEndpoints';
    protected const ARGUMENTS = ['author', 'slug'];
    protected const REQUIRED = ['author', 'slug'];
}
