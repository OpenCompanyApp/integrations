<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the GetDetailedProject returns a project that include project, global project and scoped resources by name Argo CD API operation.
 */
class ArgoCdProjectGetDetailedProject extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_project_get_detailed_project';
}
