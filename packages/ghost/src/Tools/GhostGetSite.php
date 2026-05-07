<?php
namespace OpenCompany\Integrations\Ghost\Tools;
use OpenCompany\IntegrationCore\Support\ToolResult;
/** Get Ghost site metadata. */
class GhostGetSite extends AbstractGhostTool { public function name(): string { return 'ghost_get_site'; } public function description(): string { return 'Get Ghost site metadata.'; } public function parameters(): array { return []; } /** @param array<string, mixed> $args Tool arguments. */ public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->getSite()); } }
