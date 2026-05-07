<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the Rollback syncs an application to its target state Argo CD API operation.
 */
class ArgoCdApplicationRollback extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_rollback';
}
