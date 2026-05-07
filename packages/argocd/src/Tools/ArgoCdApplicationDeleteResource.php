<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the DeleteResource deletes a single application resource Argo CD API operation.
 */
class ArgoCdApplicationDeleteResource extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_delete_resource';
}
