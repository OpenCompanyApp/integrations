<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the ListEvents returns a list of project events Argo CD API operation.
 */
class ArgoCdProjectListEvents extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_project_list_events';
}
