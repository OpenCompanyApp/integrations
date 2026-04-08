<?php

namespace OpenCompany\Integrations\Vonage\Tools;

use OpenCompany\Integrations\Vonage\VonageService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VonageVerifyRequest implements Tool
{
    /**
     * Create a new VonageVerifyRequest tool instance.
     */
    public function __construct(
        private VonageService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'vonage_verify_request';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Send a verification code to a phone number via Vonage Verify. Returns a request_id used to check the code later.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'number' => ['type' => 'string', 'required' => true, 'description' => 'Phone number to verify in E.164 format (e.g., "14155552671").'],
            'brand' => ['type' => 'string', 'required' => true, 'description' => 'The name of the company or app shown in the verification message (e.g., "MyApp").'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vonage integration is not configured.');
            }

            $data = [
                'number' => $args['number'],
                'brand' => $args['brand'],
            ];

            $result = $this->service->verifyRequest($data);

            if (($result['status'] ?? '1') !== '0') {
                $errorText = $result['error_text'] ?? 'Unknown error';

                return ToolResult::error("Verify request failed: {$errorText}");
            }

            return ToolResult::success([
                'request_id' => $result['request_id'] ?? null,
                'status' => $result['status'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
