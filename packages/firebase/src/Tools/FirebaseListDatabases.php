<?php

namespace OpenCompany\Integrations\Firebase\Tools;

use OpenCompany\Integrations\Firebase\FirebaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FirebaseListDatabases implements Tool
{
    /**
     * @param FirebaseService $service The Firebase service instance.
     */
    public function __construct(
        private FirebaseService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'firebase_list_databases';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List Cloud Firestore databases in a Firebase project.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'description' => 'The parent project name (e.g. "projects/my-project-id"). If omitted, uses the configured project ID.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array $args The tool arguments.
     * @return ToolResult The result of the tool execution.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Firebase integration is not configured.');
            }

            $parent = $args['parent'] ?? 'projects/' . ($args['_project_id'] ?? '');
            if (empty($parent) || $parent === 'projects/') {
                return ToolResult::error('Parent project is required (e.g. "projects/my-project-id"). Configure a project ID or pass the parent parameter.');
            }

            $result = $this->service->listDatabases($parent);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
