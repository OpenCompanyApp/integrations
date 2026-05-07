<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the Get the meta-data author, date, tags, message for a specific revision of the application Argo CD API operation.
 */
class ArgoCdApplicationRevisionMetadata extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_revision_metadata';
}
