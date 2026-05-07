<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the TerminateOperation terminates the currently running operation Argo CD API operation.
 */
class ArgoCdApplicationTerminateOperation extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_terminate_operation';
}
