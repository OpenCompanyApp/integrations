<?php

namespace OpenCompany\Integrations\Vonage\Tools;

use OpenCompany\Integrations\Vonage\VonageService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VonageVerifyCheck implements Tool
{
    /**
     * Create a new VonageVerifyCheck tool instance.
     */
    public function __construct(
        private VonageService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'vonage_verify_check';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Check a verification code against a Vonage Verify request. Provide the request_id from the verification and the code entered by the user.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'request_id' => ['type' => 'string', 'required' => true, 'description' => 'The request_id returned by the verify request.'],
            'code' => ['type' => 'string', 'required' => true, 'description' => 'The verification code entered by the user.'],
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

            $requestId = $args['request_id'];
            $code = $args['code'];

            $result = $this->service->verifyCheck($requestId, $code);

            if (($result['status'] ?? '1') !== '0') {
                $errorText = $result['error_text'] ?? 'Unknown error';

                return ToolResult::error("Verify check failed: {$errorText}");
            }

            return ToolResult::success([
                'request_id' => $result['request_id'] ?? null,
                'status' => $result['status'] ?? null,
                'event_id' => $result['event_id'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
