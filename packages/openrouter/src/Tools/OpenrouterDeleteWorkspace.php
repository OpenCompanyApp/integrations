<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** Delete an OpenRouter workspace. */
class OpenrouterDeleteWorkspace extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_delete_workspace';
    protected const DESCRIPTION = 'Delete an OpenRouter workspace.';
    protected const METHOD = 'deleteWorkspace';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
