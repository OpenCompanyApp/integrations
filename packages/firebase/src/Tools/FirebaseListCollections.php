<?php

namespace OpenCompany\Integrations\Firebase\Tools;

use OpenCompany\Integrations\Firebase\FirebaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FirebaseListCollections implements Tool
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
        return 'firebase_list_collections';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List collection IDs under a Firestore document or database root.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'The parent resource (e.g. "projects/my-project/databases/(default)/documents").'],
            'page_size' => ['type' => 'integer', 'description' => 'Maximum number of collection IDs to return.'],
            'page_token' => ['type' => 'string', 'description' => 'Token for pagination from a previous list call.'],
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

            if (empty($args['parent'])) {
                return ToolResult::error('Parent resource is required (e.g. "projects/my-project/databases/(default)/documents").');
            }

            $data = [];
            if (isset($args['page_size'])) {
                $data['pageSize'] = (int) $args['page_size'];
            }
            if (isset($args['page_token'])) {
                $data['pageToken'] = $args['page_token'];
            }

            $result = $this->service->listCollections($args['parent'], $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
