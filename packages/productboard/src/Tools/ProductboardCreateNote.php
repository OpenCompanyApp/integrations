<?php

namespace OpenCompany\Integrations\Productboard\Tools;

use OpenCompany\Integrations\Productboard\ProductboardService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new note in Productboard.
 *
 * Notes capture customer feedback, insights, and requests. They can
 * be linked to features and assigned to owners. The note content
 * supports Productboard's rich text format.
 */
class ProductboardCreateNote implements Tool
{
    public function __construct(
        private ProductboardService $service,
    ) {}

    public function name(): string
    {
        return 'productboard_create_note';
    }

    public function description(): string
    {
        return 'Create a new note (customer feedback) in Productboard. Requires at minimum a title. Optionally set content, owner, and linked features.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The note title.'],
            'content' => ['type' => 'string', 'description' => 'The note content (plain text or HTML).'],
            'owner_id' => ['type' => 'string', 'description' => 'User ID of the note owner.'],
            'feature_ids' => ['type' => 'array', 'description' => 'Array of feature IDs to link this note to.'],
            'company_ids' => ['type' => 'array', 'description' => 'Array of company IDs associated with this note.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Productboard integration is not configured.');
            }

            if (empty($args['title'])) {
                return ToolResult::error('Note title is required.');
            }

            $data = ['title' => $args['title']];

            if (isset($args['content'])) {
                $data['content'] = $args['content'];
            }

            if (isset($args['owner_id'])) {
                $data['owner_id'] = $args['owner_id'];
            }

            if (isset($args['feature_ids'])) {
                $data['feature_ids'] = $args['feature_ids'];
            }

            if (isset($args['company_ids'])) {
                $data['company_ids'] = $args['company_ids'];
            }

            $result = $this->service->createNote($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
