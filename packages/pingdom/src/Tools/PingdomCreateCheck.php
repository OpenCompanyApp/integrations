<?php

namespace OpenCompany\Integrations\Pingdom\Tools;

use OpenCompany\Integrations\Pingdom\PingdomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PingdomCreateCheck implements Tool
{
    public function __construct(
        private PingdomService $service,
    ) {}

    public function name(): string
    {
        return 'pingdom_create_check';
    }

    public function description(): string
    {
        return 'Create a new uptime check in Pingdom. Supports HTTP, HTTPS, TCP, ping, DNS, UDP, SMTP, POP3, and IMAP check types.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the check.'],
            'host' => ['type' => 'string', 'required' => true, 'description' => 'Target hostname or IP address.'],
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Check type: "http", "https", "tcp", "ping", "dns", "udp", "smtp", "pop3", "imap".'],
            'resolution' => ['type' => 'integer', 'description' => 'Check interval in minutes (1, 5, 15, 30, 60). Default: 5.'],
            'url' => ['type' => 'string', 'description' => 'URL path for HTTP/HTTPS checks (e.g., "/health").'],
            'port' => ['type' => 'integer', 'description' => 'Target port for TCP/UDP checks.'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated tags for the check.'],
            'send_string' => ['type' => 'string', 'description' => 'String to send for TCP/UDP checks.'],
            'expect_string' => ['type' => 'string', 'description' => 'Expected response string for TCP checks.'],
            'contactids' => ['type' => 'string', 'description' => 'Comma-separated contact IDs to alert.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pingdom integration is not configured.');
            }

            $data = [
                'name' => $args['name'],
                'host' => $args['host'],
            ];

            // Build the type-specific configuration
            $typeValue = $args['type'];
            $typeConfig = [];

            if (in_array($typeValue, ['http', 'https'])) {
                $typeConfig['url'] = $args['url'] ?? '/';
                $typeConfig['encryption'] = ($typeValue === 'https');
                $typeValue = 'http';
            } elseif ($typeValue === 'tcp' || $typeValue === 'udp') {
                if (isset($args['port'])) {
                    $typeConfig['port'] = (int) $args['port'];
                }
                if (isset($args['send_string'])) {
                    $typeConfig['string_to_send'] = $args['send_string'];
                }
                if (isset($args['expect_string'])) {
                    $typeConfig['string_to_expect'] = $args['expect_string'];
                }
            } elseif ($typeValue === 'dns') {
                if (isset($args['port'])) {
                    $typeConfig['port'] = (int) $args['port'];
                }
            }

            $data['type'] = [$typeValue => $typeConfig];

            if (isset($args['resolution'])) {
                $data['resolution'] = (int) $args['resolution'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }
            if (isset($args['contactids'])) {
                $data['contactids'] = $args['contactids'];
            }

            $result = $this->service->createCheck($data);

            return ToolResult::success([
                'message' => 'Check created successfully.',
                'check' => $result['check'] ?? $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
