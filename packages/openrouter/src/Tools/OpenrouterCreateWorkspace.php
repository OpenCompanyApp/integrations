<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Create an OpenRouter workspace. */
class OpenrouterCreateWorkspace extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_create_workspace';
    protected const DESCRIPTION = 'Create an OpenRouter workspace.';
    protected const METHOD = 'createWorkspace';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
