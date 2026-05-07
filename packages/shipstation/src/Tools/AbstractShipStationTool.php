<?php

namespace OpenCompany\Integrations\ShipStation\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ShipStation\ShipStationService;

/** Shared executor for documented ShipStation operation tools. */
abstract class AbstractShipStationTool implements Tool
{
    protected const OPERATION = '';
    /** @param ShipStationService $service ShipStation API client. */
    public function __construct(protected ShipStationService $service) {}
    public function name(): string { return 'shipstation_'.static::OPERATION; }
    public function description(): string { return (string) $this->definition()[5]; }
    public function parameters(): array { $parameters=[]; foreach($this->definition()[2] as $field){$parameters[(string)$field]=['type'=>'string','required'=>true,'description'=>str_replace('_',' ',ucfirst((string)$field)).'.'];} $parameters['payload']=['type'=>'object','description'=>'Additional query or JSON body fields.']; return $parameters; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { try { return ToolResult::success($this->service->call(static::OPERATION, $this->payload($args))); } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); } }
    /** @param array<string, mixed> $args @return array<string, mixed> */
    private function payload(array $args): array { $payload=isset($args['payload'])&&is_array($args['payload'])?$args['payload']:[]; foreach($args as $key=>$value){if($key!=='payload') $payload[$key]=$value;} return $payload; }
    /** @return array<int, mixed> */
    private function definition(): array { $definition=ShipStationService::operations()[static::OPERATION]??null; if($definition===null) throw new \RuntimeException('Unknown ShipStation operation: '.static::OPERATION); return $definition; }
}
