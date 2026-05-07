<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the ValidateWriteAccess validates write access to a repository with given parameters Argo CD API operation.
 */
class ArgoCdRepositoryValidateWriteAccess extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repository_validate_write_access';
}
