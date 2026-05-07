<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the DeleteRepository deletes a repository from the configuration Argo CD API operation.
 */
class ArgoCdRepositoryDeleteRepository extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repository_delete_repository';
}
