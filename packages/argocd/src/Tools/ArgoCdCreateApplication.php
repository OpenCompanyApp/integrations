<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

use OpenCompany\Integrations\ArgoCd\ArgoCdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Argo CD application.
 */
class ArgoCdCreateApplication implements Tool
{
    /** @param  ArgoCdService  $service  The Argo CD API client */
    public function __construct(
        private ArgoCdService $service,
    ) {}

    public function name(): string
    {
        return 'argocd_create_application';
    }

    public function description(): string
    {
        return 'Create a new Argo CD application. Requires application name, project, source repository with path and revision, and destination cluster/namespace.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the application.'],
            'project' => ['type' => 'string', 'required' => true, 'description' => 'The Argo CD project this application belongs to.'],
            'repo_url' => ['type' => 'string', 'required' => true, 'description' => 'The Git repository URL for the application source.'],
            'path' => ['type' => 'string', 'required' => true, 'description' => 'The path within the repository containing the Kubernetes manifests or Kustomize/Helm config.'],
            'revision' => ['type' => 'string', 'description' => 'The Git revision (branch, tag, or commit SHA) to track. Defaults to HEAD.'],
            'dest_server' => ['type' => 'string', 'description' => 'The destination Kubernetes cluster API URL. Defaults to "https://kubernetes.default.svc".'],
            'dest_namespace' => ['type' => 'string', 'required' => true, 'description' => 'The destination Kubernetes namespace.'],
            'sync_policy' => ['type' => 'string', 'description' => 'Sync policy: "automated" for auto-sync, "manual" or empty for manual sync.'],
            'sync_options' => ['type' => 'string', 'description' => 'Comma-separated sync options (e.g. "CreateNamespace=true,PrunePropagationPolicy=foreground").'],
            'labels' => ['type' => 'object', 'description' => 'Key-value labels to apply to the application (e.g. {"env": "production"}).'],
            'description' => ['type' => 'string', 'description' => 'A human-readable description of the application.'],
        ];
    }

    /**
     * Create an Argo CD application.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Argo CD is not configured. Missing Bearer token.');
        }

        $name = $args['name'] ?? '';
        $project = $args['project'] ?? '';
        $repoUrl = $args['repo_url'] ?? '';
        $path = $args['path'] ?? '';
        $destNamespace = $args['dest_namespace'] ?? '';

        if (empty($name) || empty($project) || empty($repoUrl) || empty($path) || empty($destNamespace)) {
            return ToolResult::error('Fields name, project, repo_url, path, and dest_namespace are all required.');
        }

        try {
            $application = [
                'metadata' => [
                    'name' => $name,
                ],
                'spec' => [
                    'project' => $project,
                    'source' => [
                        'repoURL' => $repoUrl,
                        'path' => $path,
                    ],
                    'destination' => [
                        'server' => $args['dest_server'] ?? 'https://kubernetes.default.svc',
                        'namespace' => $destNamespace,
                    ],
                ],
            ];

            if (! empty($args['revision'])) {
                $application['spec']['source']['targetRevision'] = $args['revision'];
            }

            if (! empty($args['sync_policy']) && $args['sync_policy'] === 'automated') {
                $application['spec']['syncPolicy'] = ['automated' => ['selfHeal' => true, 'prune' => false]];
            }

            if (! empty($args['sync_options'])) {
                $application['spec']['syncPolicy']['syncOptions'] = explode(',', $args['sync_options']);
            }

            if (! empty($args['labels'])) {
                $application['metadata']['labels'] = $args['labels'];
            }

            if (! empty($args['description'])) {
                $application['metadata']['annotations'] = ['description' => $args['description']];
            }

            $result = $this->service->createApplication($application);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
