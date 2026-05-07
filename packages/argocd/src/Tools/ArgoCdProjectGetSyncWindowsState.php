<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the GetSchedulesState returns true if there are any active sync syncWindows Argo CD API operation.
 */
class ArgoCdProjectGetSyncWindowsState extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_project_get_sync_windows_state';
}
