<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the DeleteWriteRepository deletes a write repository from the configuration Argo CD API operation.
 */
class ArgoCdRepositoryDeleteWriteRepository extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repository_delete_write_repository';
}
