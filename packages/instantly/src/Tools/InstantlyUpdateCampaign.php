<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing campaign configuration.
 */
class InstantlyUpdateCampaign implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_campaign';
    }

    public function description(): string
    {
        return 'Update an existing campaign configuration.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Campaign ID'],
            'name' => ['type' => 'string', 'required' => false, 'description' => 'Campaign name'],
            'open_tracking' => ['type' => 'boolean', 'required' => false, 'description' => 'Open tracking'],
            'link_tracking' => ['type' => 'boolean', 'required' => false, 'description' => 'Link tracking'],
            'text_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Plain text only'],
            'stop_on_reply' => ['type' => 'boolean', 'required' => false, 'description' => 'Stop on reply'],
            'daily_limit' => ['type' => 'integer', 'required' => false, 'description' => 'Max emails/day'],
            'email_gap' => ['type' => 'integer', 'required' => false, 'description' => 'Minutes between emails'],
            'email_list' => ['type' => 'array', 'required' => false, 'description' => 'Sender emails', 'items' => ['type' => 'string']],
            'sequences' => ['type' => 'string', 'required' => false, 'description' => 'JSON sequences'],
            'campaign_schedule' => ['type' => 'string', 'required' => false, 'description' => 'JSON schedule'],
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

            $result = $id = $args['id']; $body = []; foreach (['name','open_tracking','link_tracking','text_only','stop_on_reply','stop_on_auto_reply','daily_limit','email_gap'] as $f) if (isset($args[$f])) $body[$f] = $args[$f]; foreach (['email_list','sequences','campaign_schedule'] as $f) if (isset($args[$f])) { $v = $args[$f]; $body[$f] = is_string($v) ? json_decode($v, true) : $v; } $this->service->updateCampaign($id, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
