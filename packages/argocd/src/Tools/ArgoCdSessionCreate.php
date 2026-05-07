<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the Create a new JWT for authentication and set a cookie if using HTTP Argo CD API operation.
 */
class ArgoCdSessionCreate extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_session_create';
}
