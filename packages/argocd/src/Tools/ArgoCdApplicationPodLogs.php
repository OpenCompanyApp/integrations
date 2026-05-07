<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the PodLogs returns stream of log entries for the specified pod. Pod Argo CD API operation.
 */
class ArgoCdApplicationPodLogs extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_application_pod_logs';
}
