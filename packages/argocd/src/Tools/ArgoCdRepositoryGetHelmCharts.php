<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the GetHelmCharts returns list of helm charts in the specified repository Argo CD API operation.
 */
class ArgoCdRepositoryGetHelmCharts extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_repository_get_helm_charts';
}
