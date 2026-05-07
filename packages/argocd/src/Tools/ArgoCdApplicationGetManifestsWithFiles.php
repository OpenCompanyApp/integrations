<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the GetManifestsWithFiles returns application manifests using provided files to generate them Argo CD API operation.
 */
class ArgoCdApplicationGetManifestsWithFiles extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_get_manifests_with_files';
}
