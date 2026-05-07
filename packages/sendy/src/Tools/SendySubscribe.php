<?php

namespace OpenCompany\Integrations\Sendy\Tools;

use OpenCompany\Integrations\Sendy\SendyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Subscribe or update an email address on a Sendy list.
 *
 * Supports standard Sendy subscriber fields and arbitrary custom field tags.
 */
class SendySubscribe implements Tool
{
    /**
     * @param  SendyService  $service  The Sendy API client
     */
    public function __construct(
        private SendyService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'sendy_subscribe';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Subscribe an email address to a Sendy mailing list. Optionally provide a name and custom fields.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'list' => ['type' => 'string', 'required' => true, 'description' => 'The list ID to subscribe to.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber\'s email address.'],
            'name' => ['type' => 'string', 'description' => 'The subscriber\'s name (optional).'],
            'country' => ['type' => 'string', 'description' => 'Optional two-letter country code.'],
            'ipaddress' => ['type' => 'string', 'description' => 'Optional signup IP address.'],
            'referrer' => ['type' => 'string', 'description' => 'Optional signup referrer URL.'],
            'gdpr' => ['type' => 'string', 'description' => 'Set to "true" for GDPR-compliant signups.'],
            'silent' => ['type' => 'string', 'description' => 'Set to "true" to bypass double opt-in where appropriate.'],
            'custom_fields' => ['type' => 'object', 'description' => 'Additional custom field tag values, keyed by the Sendy personalization tag name.'],
        ];
    }

    /**
     * Execute the subscribe tool.
     *
     * @param  array<string, mixed>  $args
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sendy integration is not configured.');
            }

            $list = $args['list'];
            $email = $args['email'];
            $name = $args['name'] ?? null;
            $customFields = [];
            foreach (['country', 'ipaddress', 'referrer', 'gdpr', 'silent', 'hp'] as $key) {
                if (isset($args[$key])) {
                    $customFields[$key] = $args[$key];
                }
            }
            if (isset($args['custom_fields']) && is_array($args['custom_fields'])) {
                $customFields = array_merge($customFields, $args['custom_fields']);
            }

            $result = $this->service->subscribe($list, $email, $name, $customFields);

            if ($result['status'] === 'success') {
                return ToolResult::success([
                    'list' => $list,
                    'email' => $email,
                    'message' => $result['message'],
                ]);
            }

            return ToolResult::error($result['message']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
