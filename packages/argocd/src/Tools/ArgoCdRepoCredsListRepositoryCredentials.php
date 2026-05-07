<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the ListRepositoryCredentials gets a list of all configured repository credential sets Argo CD API operation.
 */
class ArgoCdRepoCredsListRepositoryCredentials extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repo_creds_list_repository_credentials';
}
