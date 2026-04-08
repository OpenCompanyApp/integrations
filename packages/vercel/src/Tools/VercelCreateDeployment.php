<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\Integrations\Vercel\VercelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new deployment on Vercel.
 *
 * Requires a project name and the files or Git source to deploy.
 * Wraps <code>POST /v13/deployments</code>.
 */
class VercelCreateDeployment implements Tool
{
    public function __construct(
        private VercelService $service,
    ) {}

    public function name(): string
    {
        return 'vercel_create_deployment';
    }

    public function description(): string
    {
        return 'Create a new deployment on Vercel. Provide a project name and either file contents or a Git source reference. Returns the new deployment ID and URL.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The project name to deploy to (must match an existing Vercel project).'],
            'files' => ['type' => 'array', 'description' => 'Array of file objects with "file" (path) and "content" (base64-encoded or sha+size). Required for direct uploads.'],
            'git_source' => ['type' => 'object', 'description' => 'Git source reference, e.g. {"type": "github", "ref": "main", "repoId": 12345}. Alternative to files.'],
            'target' => ['type' => 'string', 'description' => 'Deployment target: "production" or "preview" (default: "preview").'],
            'framework' => ['type' => 'string', 'description' => 'Framework preset slug (e.g., "nextjs", "remix", "nuxtjs").'],
            'regions' => ['type' => 'array', 'description' => 'List of region codes to deploy to (e.g., ["iad1", "sfo1"]).'],
            'project_settings' => ['type' => 'object', 'description' => 'Override project settings for this deployment (buildCommand, outputDirectory, installCommand, etc.).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vercel integration is not configured.');
            }

            $body = [
                'name' => $args['name'],
            ];

            if (isset($args['files'])) {
                $body['files'] = $args['files'];
            }

            if (isset($args['git_source'])) {
                $body['gitSource'] = $args['git_source'];
            }

            if (isset($args['target'])) {
                $body['target'] = $args['target'];
            }

            if (isset($args['framework'])) {
                $body['framework'] = $args['framework'];
            }

            if (isset($args['regions'])) {
                $body['regions'] = $args['regions'];
            }

            if (isset($args['project_settings'])) {
                $body['projectSettings'] = $args['project_settings'];
            }

            $result = $this->service->createDeployment($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
