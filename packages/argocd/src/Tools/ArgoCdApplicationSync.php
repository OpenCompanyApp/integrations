<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the Sync syncs an application to its target state Argo CD API operation.
 */
class ArgoCdApplicationSync extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_sync';
}
