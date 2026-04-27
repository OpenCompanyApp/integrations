<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new campaign with full configuration including sequences, schedule, and sender accounts.
 */
class InstantlyCreateCampaign implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_campaign';
    }

    public function description(): string
    {
        return 'Create a new campaign with full configuration including sequences, schedule, and sender accounts.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Campaign name'],
            'open_tracking' => ['type' => 'boolean', 'required' => false, 'description' => 'Enable open tracking'],
            'link_tracking' => ['type' => 'boolean', 'required' => false, 'description' => 'Enable link tracking'],
            'text_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Plain text only'],
            'stop_on_reply' => ['type' => 'boolean', 'required' => false, 'description' => 'Stop on reply'],
            'stop_on_auto_reply' => ['type' => 'boolean', 'required' => false, 'description' => 'Stop on auto-reply'],
            'daily_limit' => ['type' => 'integer', 'required' => false, 'description' => 'Max emails/day per account'],
            'email_gap' => ['type' => 'integer', 'required' => false, 'description' => 'Minutes between emails'],
            'email_list' => ['type' => 'array', 'required' => false, 'description' => 'Sender email addresses', 'items' => ['type' => 'string']],
            'sequences' => ['type' => 'string', 'required' => false, 'description' => 'JSON sequences array'],
            'campaign_schedule' => ['type' => 'string', 'required' => false, 'description' => 'JSON schedule object'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = ['name' => $args['name']]; foreach (['open_tracking','link_tracking','text_only','stop_on_reply','stop_on_auto_reply','daily_limit','email_gap'] as $f) if (isset($args[$f])) $body[$f] = $args[$f]; foreach (['email_list','sequences','campaign_schedule'] as $f) if (isset($args[$f])) { $v = $args[$f]; $body[$f] = is_string($v) ? json_decode($v, true) : $v; } $result = $this->service->createCampaign($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
