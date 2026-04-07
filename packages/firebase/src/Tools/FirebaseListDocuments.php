<?php

namespace OpenCompany\Integrations\Firebase\Tools;

use OpenCompany\Integrations\Firebase\FirebaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FirebaseListDocuments implements Tool
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
        return 'firebase_list_documents';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'List documents in a Firestore collection.';
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
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The collection ID to list documents from.'],
            'page_size' => ['type' => 'integer', 'description' => 'Maximum number of documents to return.'],
            'page_token' => ['type' => 'string', 'description' => 'Token for pagination from a previous list call.'],
            'order_by' => ['type' => 'string', 'description' => 'Field to order results by.'],
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

            if (empty($args['collection_id'])) {
                return ToolResult::error('Collection ID is required.');
            }

            $params = [];
            if (isset($args['page_size'])) {
                $params['pageSize'] = (int) $args['page_size'];
            }
            if (isset($args['page_token'])) {
                $params['pageToken'] = $args['page_token'];
            }
            if (isset($args['order_by'])) {
                $params['orderBy'] = $args['order_by'];
            }

            $result = $this->service->listDocuments($args['parent'], $args['collection_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
