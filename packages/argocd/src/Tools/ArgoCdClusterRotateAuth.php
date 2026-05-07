<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the RotateAuth rotates the bearer token used for a cluster Argo CD API operation.
 */
class ArgoCdClusterRotateAuth extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_cluster_rotate_auth';
}
