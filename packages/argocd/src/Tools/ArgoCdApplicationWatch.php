<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the Watch returns stream of application change events Argo CD API operation.
 */
class ArgoCdApplicationWatch extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_watch';
}
