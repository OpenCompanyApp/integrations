<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the ListWriteRepositories gets a list of all configured write repositories Argo CD API operation.
 */
class ArgoCdRepositoryListWriteRepositories extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repository_list_write_repositories';
}
