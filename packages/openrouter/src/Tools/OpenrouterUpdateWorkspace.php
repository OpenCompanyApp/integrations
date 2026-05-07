<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Update an OpenRouter workspace. */
class OpenrouterUpdateWorkspace extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_update_workspace';
    protected const DESCRIPTION = 'Update an OpenRouter workspace.';
    protected const METHOD = 'updateWorkspace';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id', 'payload'];
    protected const USE_PAYLOAD = true;
}
