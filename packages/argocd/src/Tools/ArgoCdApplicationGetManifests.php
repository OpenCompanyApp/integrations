<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the GetManifests returns application manifests Argo CD API operation.
 */
class ArgoCdApplicationGetManifests extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_get_manifests';
}
