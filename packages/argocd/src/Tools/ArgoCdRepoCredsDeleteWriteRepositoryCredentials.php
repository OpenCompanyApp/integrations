<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the DeleteWriteRepositoryCredentials deletes a repository credential set with write access from the configuration Argo CD API operation.
 */
class ArgoCdRepoCredsDeleteWriteRepositoryCredentials extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repo_creds_delete_write_repository_credentials';
}
