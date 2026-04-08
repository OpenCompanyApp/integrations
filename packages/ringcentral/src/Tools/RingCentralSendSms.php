<?php

namespace OpenCompany\Integrations\RingCentral\Tools;

use OpenCompany\Integrations\RingCentral\RingCentralService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to send an SMS message via RingCentral.
 */
class RingCentralSendSms implements Tool
{
    /**
     * Create a new RingCentralSendSms tool instance.
     *
     * @param  RingCentralService  $service  The RingCentral API service.
     */
    public function __construct(
        private RingCentralService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'ringcentral_send_sms';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Send an SMS message via RingCentral. The "from" number must be a phone number assigned to the authenticated extension. The "to" number is the destination phone number.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'from' => ['type' => 'string', 'required' => true, 'description' => 'The phone number to send from (must be a RingCentral number assigned to the extension, e.g., "+16505551234").'],
            'to' => ['type' => 'string', 'required' => true, 'description' => 'The destination phone number (e.g., "+16505559876").'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The SMS message body text. Maximum 160 characters per segment; longer messages are concatenated.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array  $args  The tool arguments matching parameter definitions.
     * @return ToolResult The result containing the sent message details or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RingCentral integration is not configured.');
            }

            if (empty($args['from']) || empty($args['to']) || empty($args['text'])) {
                return ToolResult::error('from, to, and text are all required.');
            }

            $result = $this->service->sendSms($args['from'], $args['to'], $args['text']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
