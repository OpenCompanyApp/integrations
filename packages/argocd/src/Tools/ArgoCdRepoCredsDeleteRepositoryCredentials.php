<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the DeleteRepositoryCredentials deletes a repository credential set from the configuration Argo CD API operation.
 */
class ArgoCdRepoCredsDeleteRepositoryCredentials extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repo_creds_delete_repository_credentials';
}
