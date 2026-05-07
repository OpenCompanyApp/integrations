<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Get one OpenRouter workspace. */
class OpenrouterGetWorkspace extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_get_workspace';
    protected const DESCRIPTION = 'Get one OpenRouter workspace.';
    protected const METHOD = 'getWorkspace';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
