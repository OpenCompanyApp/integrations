<?php

namespace OpenCompany\Integrations\SparkPost\Tools;

use OpenCompany\Integrations\SparkPost\SparkPostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: SparkPostGetTemplate
 *
 * Retrieves a specific email template by its ID. Optionally retrieves
 * the draft version instead of the published version.
 */
class SparkPostGetTemplate implements Tool
{
    /**
     * @param  SparkPostService  $service  The SparkPost API service instance.
     */
    public function __construct(
        private SparkPostService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'spark_post_get_template';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Get a specific email template by ID from SparkPost. Can retrieve the draft or published version.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The template ID to retrieve.'],
            'draft' => ['type' => 'boolean', 'description' => 'Set to true to retrieve the draft version of the template. Defaults to false (published version).'],
        ];
    }

    /**
     * Execute the tool — get a single template.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult The template details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SparkPost integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $draft = $args['draft'] ?? null;
            $result = $this->service->getTemplate($id, is_bool($draft) ? $draft : null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
