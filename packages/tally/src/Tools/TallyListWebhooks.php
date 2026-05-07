<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Tally webhook subscriptions.
 */
class TallyListWebhooks extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_list_webhooks';
    }

    public function description(): string
    {
        return 'List Tally webhook subscriptions with pagination.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of webhooks per page, max 100.'],
        ];
    }

    /**
     * Execute the list webhooks request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listWebhooks(
            $this->params($args, ['page', 'limit']),
        ));
    }
}
