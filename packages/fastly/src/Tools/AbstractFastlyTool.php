<?php

namespace OpenCompany\Integrations\Fastly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fastly\FastlyService;

/**
 * Shared executor for Fastly endpoint-specific tools.
 *
 * Child classes map to generated Fastly client operations while this class
 * handles configured-state checks and operation dispatch.
 */
abstract class AbstractFastlyTool implements Tool
{
    protected const NAME=''; protected const DESCRIPTION=''; protected const PARAMETERS=[]; protected const OPERATION=[];
    /** @param  FastlyService  $service  Fastly API client. */ public function __construct(protected FastlyService $service) {}
    public function name(): string { return static::NAME; } public function description(): string { return static::DESCRIPTION; } public function parameters(): array { return static::PARAMETERS; }
    /** @param  array<string, mixed>  $args  Tool arguments for the mapped Fastly operation. */ public function execute(array $args): ToolResult { try { if(!$this->service->isConfigured()) return ToolResult::error('Fastly integration is not configured.'); return ToolResult::success($this->service->executeOperation(static::OPERATION, $args)); } catch(\Throwable $e) { return ToolResult::error($e->getMessage()); } }
}