<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the ListApps returns list of apps in the repo Argo CD API operation.
 */
class ArgoCdRepositoryListApps extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repository_list_apps';
}
