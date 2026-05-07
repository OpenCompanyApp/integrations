<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\Integrations\WorldBank\WorldBankService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List World Bank topics or indicators in a topic.
 */
class WorldBankTopics implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(
        private WorldBankService $service,
    ) {}

    public function name(): string
    {
        return 'worldbank_topics';
    }

    public function description(): string
    {
        return 'List the 21 World Bank topic categories (e.g., Education, Health, Economy). Optionally provide a topic ID to list indicators in that topic.';
    }

    public function parameters(): array
    {
        return [
            'topic_id' => ['type' => 'string', 'description' => 'Topic ID to list indicators for that topic. Omit to see all available topics.'],
        ];
    }

    /**
     * List topics or topic indicators.
     *
     * @param  array<string, mixed>  $args  Tool arguments (topic_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $topicId = $args['topic_id'] ?? null;

            if ($topicId) {
                $result = $this->service->getTopicIndicators((int) $topicId);
                $indicators = $result['data'] ?? [];

                $slim = array_map(fn (array $ind) => [
                    'code' => $ind['id'] ?? null,
                    'name' => $ind['name'] ?? null,
                    'source' => $ind['source']['value'] ?? null,
                ], array_slice($indicators, 0, 50));

                return ToolResult::success([
                    'topic_id' => $topicId,
                    'total' => $result['meta']['total'] ?? count($slim),
                    'showing' => count($slim),
                    'indicators' => $slim,
                ]);
            }

            $result = $this->service->getTopics();
            $topics = $result['data'] ?? [];

            $slim = array_values(array_filter(array_map(fn (array $t) => [
                'id' => $t['id'] ?? null,
                'name' => $t['value'] ?? null,
                'sourceNote' => $t['sourceNote'] ?? null,
            ], $topics), fn (array $t) => ! empty($t['name'])));

            return ToolResult::success(['topics' => $slim]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
