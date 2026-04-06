<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

use OpenCompany\Integrations\Clearbit\ClearbitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clearbit_reveal
 *
 * Identifies the company and person behind an IP address using the Clearbit
 * Reveal API. Useful for de-anonymizing website visitors in real time.
 *
 * Endpoint: GET /reveal?ip=…
 */
class ClearbitReveal implements Tool
{
    /**
     * @param  ClearbitService  $service  The Clearbit API service instance.
     */
    public function __construct(
        private ClearbitService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'clearbit_reveal';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Identify the company and person behind an IP address using Clearbit Reveal. Returns company information and, when available, the associated person.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ip' => ['type' => 'string', 'required' => true, 'description' => 'The IP address to look up (IPv4 or IPv6, e.g., "104.193.168.24").'],
        ];
    }

    /**
     * Execute the IP reveal lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing at least 'ip'.
     * @return ToolResult The revealed company/person data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clearbit integration is not configured.');
            }

            $ip = $args['ip'] ?? '';
            if (empty($ip)) {
                return ToolResult::error('An IP address is required.');
            }

            $result = $this->service->reveal($ip);

            if (empty($result)) {
                return ToolResult::success([
                    'ip' => $ip,
                    'found' => false,
                    'message' => 'No company or person data found for this IP address.',
                ]);
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
