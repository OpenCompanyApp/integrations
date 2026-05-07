<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the CanI checks if the current account has permission to perform an action Argo CD API operation.
 */
class ArgoCdAccountCanI extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_account_can_i';
}
