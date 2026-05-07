<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the InvalidateCache invalidates cluster cache Argo CD API operation.
 */
class ArgoCdClusterInvalidateCache extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_cluster_invalidate_cache';
}
