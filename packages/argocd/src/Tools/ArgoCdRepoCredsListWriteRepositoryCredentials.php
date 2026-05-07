<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the ListWriteRepositoryCredentials gets a list of all configured repository credential sets that have write access Argo CD API operation.
 */
class ArgoCdRepoCredsListWriteRepositoryCredentials extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repo_creds_list_write_repository_credentials';
}
