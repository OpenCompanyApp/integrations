<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

/** List OpenRouter workspaces. */
class OpenrouterListWorkspaces extends AbstractOpenrouterTool
{
    protected const NAME = 'openrouter_list_workspaces';
    protected const DESCRIPTION = 'List OpenRouter workspaces.';
    protected const METHOD = 'listWorkspaces';
    protected const USE_QUERY = true;
}
