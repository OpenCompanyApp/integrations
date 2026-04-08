<?php

namespace OpenCompany\Integrations\Twilio\Tools;

use OpenCompany\Integrations\Twilio\TwilioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Twilio recording by its SID.
 *
 * Permanently removes the recording and all associated media.
 */
class TwilioDeleteRecording implements Tool
{
    /**
     * @param  TwilioService  $service  The Twilio API client
     */
    public function __construct(
        private TwilioService $service,
    ) {}

    public function name(): string
    {
        return 'twilio_delete_recording';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete a Twilio recording by its SID.
        Permanently removes the recording and all associated media. This action cannot be undone.
        MD;
    }

    public function parameters(): array
    {
        return [
            'recording_sid' => ['type' => 'string', 'required' => true, 'description' => 'Recording SID (e.g., "RExxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx").'],
        ];
    }

    /**
     * Delete a Twilio recording by SID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (recording_sid)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Twilio integration is not configured.');
            }

            $recordingSid = $args['recording_sid'] ?? '';
            if (empty($recordingSid)) {
                return ToolResult::error('recording_sid is required.');
            }

            $this->service->deleteRecording($recordingSid);

            return ToolResult::success([
                'deleted' => true,
                'recording_sid' => $recordingSid,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
