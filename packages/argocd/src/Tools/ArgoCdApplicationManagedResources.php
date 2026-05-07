<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the ManagedResources returns list of managed resources Argo CD API operation.
 */
class ArgoCdApplicationManagedResources extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_managed_resources';
}
