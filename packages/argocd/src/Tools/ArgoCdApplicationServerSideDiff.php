<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the ServerSideDiff performs server-side diff calculation using dry-run apply Argo CD API operation.
 */
class ArgoCdApplicationServerSideDiff extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_server_side_diff';
}
