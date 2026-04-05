<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a usage trigger on the Twilio account.
 *
 * Usage triggers notify a callback URL when usage exceeds a specified threshold.
 */
class TwilioCreateUsageTrigger implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_create_usage_trigger';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a usage trigger on the Twilio account.
        Twilio will notify the callback URL when usage of the specified category exceeds the trigger value.
        Supports recurring triggers (daily, monthly, yearly) or one-time triggers.
        MD;
    }

    public function parameters(): array
    {
        return [
            'usage_category' => ['type' => 'string', 'required' => true, 'description' => 'Usage category to monitor (e.g., "calls", "sms", "phonenumbers", "totalprice").'],
            'trigger_value' => ['type' => 'string', 'required' => true, 'description' => 'Usage value that triggers the callback (e.g., "100.00").'],
            'callback_url' => ['type' => 'string', 'required' => true, 'description' => 'URL Twilio will call when the trigger fires.'],
            'recurring' => ['type' => 'string', 'description' => 'Recurrence interval: "daily", "monthly", "yearly", or omit for one-time.'],
        ];
    }

    /**
     * Create a usage trigger on the Twilio account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (usage_category, trigger_value, callback_url, recurring)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $usageCategory = $args['usage_category'] ?? '';
            $triggerValue = $args['trigger_value'] ?? '';
            $callbackUrl = $args['callback_url'] ?? '';

            if (empty($usageCategory)) {
                return ToolResult::error('usage_category is required.');
            }
            if (empty($triggerValue)) {
                return ToolResult::error('trigger_value is required.');
            }
            if (empty($callbackUrl)) {
                return ToolResult::error('callback_url is required.');
            }

            $data = [
                'UsageCategory' => $usageCategory,
                'TriggerValue' => $triggerValue,
                'CallbackUrl' => $callbackUrl,
            ];

            if (! empty($args['recurring'])) {
                $data['Recurring'] = $args['recurring'];
            }

            $result = $this->service->createUsageTrigger($data);

            return ToolResult::success([
                'sid' => $result['sid'] ?? '',
                'usage_category' => $result['usage_category'] ?? '',
                'trigger_value' => $result['trigger_value'] ?? '',
                'current_value' => $result['current_value'] ?? '',
                'callback_url' => $result['callback_url'] ?? '',
                'recurring' => $result['recurring'] ?? null,
                'date_created' => $result['date_created'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
