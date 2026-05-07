<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the ListRepositories gets a list of all configured repositories Argo CD API operation.
 */
class ArgoCdListRepositories extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_list_repositories';
}
