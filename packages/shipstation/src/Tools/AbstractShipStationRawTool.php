<?php

namespace OpenCompany\Integrations\ShipStation\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ShipStation\ShipStationService;

/** Shared executor for guarded raw ShipStation API calls. */
abstract class AbstractShipStationRawTool implements Tool
{
    protected const NAME=''; protected const DESCRIPTION=''; protected const METHOD='';
    /** @param ShipStationService $service ShipStation API client. */
    public function __construct(protected ShipStationService $service) {}
    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return ['path'=>['type'=>'string','required'=>true,'description'=>'Relative ShipStation API path.'], 'payload'=>['type'=>'object','description'=>'Query parameters or JSON body.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { try { if(!$this->service->isConfigured()) return ToolResult::error('ShipStation API key is not configured.'); if(($args['path']??'')==='') return ToolResult::error('path is required.'); $payload=isset($args['payload'])&&is_array($args['payload'])?$args['payload']:[]; $method=static::METHOD; return ToolResult::success($this->service->{$method}((string)$args['path'],$payload)); } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); } }
}
