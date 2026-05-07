<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Update Pushover glance/widget data for the configured user.
 */
class PushoverUpdateGlance implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_update_glance';
    }

    public function description(): string
    {
        return 'Update Pushover glance data shown in the Pushover widget and wearables: title, text, subtext, count, and percent.';
    }

    public function parameters(): array
    {
        return [
            'device' => ['type' => 'string', 'description' => 'Optional target device name.'],
            'title' => ['type' => 'string', 'description' => 'Short glance title.'],
            'text' => ['type' => 'string', 'description' => 'Primary glance text.'],
            'subtext' => ['type' => 'string', 'description' => 'Secondary glance text.'],
            'count' => ['type' => 'integer', 'description' => 'Integer count shown by the glance.'],
            'percent' => ['type' => 'integer', 'description' => 'Percent value from 0 to 100.'],
        ];
    }

    /**
     * Update glance data for the configured user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (device, title, text, subtext, count, percent).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $data = [];
            foreach (['device', 'title', 'text', 'subtext'] as $key) {
                if (isset($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            foreach (['count', 'percent'] as $key) {
                if (isset($args[$key])) {
                    $data[$key] = (int) $args[$key];
                }
            }

            if ($data === []) {
                return ToolResult::error('At least one glance field is required.');
            }

            if (isset($data['percent']) && ($data['percent'] < 0 || $data['percent'] > 100)) {
                return ToolResult::error('percent must be between 0 and 100.');
            }

            return ToolResult::success($this->service->updateGlance($data));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
