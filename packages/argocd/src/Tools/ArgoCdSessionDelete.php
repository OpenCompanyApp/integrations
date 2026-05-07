<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the Delete an existing JWT cookie if using HTTP Argo CD API operation.
 */
class ArgoCdSessionDelete extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_session_delete';
}
