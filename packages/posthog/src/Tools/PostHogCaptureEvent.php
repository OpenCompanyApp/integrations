<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\PostHog\PostHogService;

/**
 * Send a custom event through PostHog's ingestion API.
 *
 * This helper covers the documented capture endpoint, which is separate from
 * the private OpenAPI operation schema.
 */
class PostHogCaptureEvent implements Tool
{
    /** @param  PostHogService  $service  PostHog HTTP API client. */
    public function __construct(private PostHogService $service) {}
    public function name(): string { return 'posthog_capture_event'; }
    public function description(): string { return 'Send one analytics event through the PostHog capture API.'; }
    public function parameters(): array { return ['event' => ['type' => 'string', 'required' => true, 'description' => 'Event name to capture.'], 'distinct_id' => ['type' => 'string', 'required' => true, 'description' => 'Identifier for the person or actor.'], 'properties' => ['type' => 'object', 'required' => false, 'description' => 'Optional event properties.'], 'timestamp' => ['type' => 'string', 'required' => false, 'description' => 'Optional ISO 8601 event timestamp.'], 'api_key' => ['type' => 'string', 'required' => false, 'description' => 'Optional project API key override. Defaults to configured project_api_key.'], 'send_feature_flags' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether PostHog should enrich the event with feature flag data.']]; }
    /** @param  array<string, mixed>  $args  Event payload with event, distinct_id, properties, and optional timestamp. */
    public function execute(array $args): ToolResult { try { if (!$this->service->canCapture()) return ToolResult::error('PostHog project API key is not configured.'); return ToolResult::success($this->service->captureEvent($args)); } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); } }
}
