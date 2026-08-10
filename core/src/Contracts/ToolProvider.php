<?php

namespace OpenCompany\IntegrationCore\Contracts;

interface ToolProvider
{
    /**
     * The app/group identifier (e.g., 'mermaid', 'clickup', 'gmail').
     */
    public function appName(): string;

    /**
     * App group metadata for system prompt catalog and UI.
     *
     * Expected keys:
     *   'label'       => string  (e.g., 'diagrams, flowcharts, sequences')
     *   'description' => string  (e.g., 'Mermaid diagram rendering')
     *   'icon'        => string  (e.g., 'ph:graph')
     *   'logo'        => string  (optional, brand logo icon)
     *
     * @return array{label: string, description: string, icon: string, logo?: string}
     */
    public function appMeta(): array;

    /**
     * Tool definitions with metadata.
     *
     * Returns slug => metadata array:
     *   'class'       => string  (FQCN of the Tool class)
     *   'type'        => string  ('read' or 'write')
     *   'name'        => string  (human-readable display name)
     *   'description' => string  (short description for listings)
     *   'icon'        => string  (Iconify icon identifier)
     *   'returns'     => array   (optional Code Mode return contract)
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string, returns?: array<string, mixed>}>
     */
    public function tools(): array;

    /**
     * Whether this is an external integration that can be toggled per agent.
     */
    public function isIntegration(): bool;

    /**
     * Create a tool instance.
     *
     * The $context array allows the host application to pass runtime
     * dependencies without coupling the core to specific models.
     * Inside OpenCompany: ['agent' => User, 'timezone' => string]
     * KosmoKrator: ['account' => string] or custom context
     */
    public function createTool(string $class, array $context = []): Tool;

    /**
     * Path to supplementary synchronous JavaScript documentation.
     *
     * Hosts append this content to generated Code Mode API references. Keep it
     * focused on executable examples, result shapes, workflows, and gotchas
     * that cannot be derived from tool parameter metadata.
     *
     * Return null if the generated reference is sufficient.
     */
    public function scriptDocsPath(): ?string;

    /**
     * Credential fields required by this integration.
     *
     * Used by CLI setup flows (KosmoKrator) to prompt users for credentials.
     * Return an empty array if the integration doesn't need credentials.
     * For OAuth redirect, device-code, service-account, web-only, or CLI-only
     * setup behavior, expose explicit host capability metadata through the
     * optional HasIntegrationCapabilities contract.
     *
     * Each entry:
     *   'key'         => string  Config storage key (e.g., 'api_key')
     *   'type'        => string  'secret' | 'string' | 'url' | 'oauth'
     *   'label'       => string  Display label (e.g., 'API Key')
     *   'required'    => bool    (default true)
     *   'placeholder' => string  (optional, hint text)
     *   'default'     => string  (optional, default value)
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, placeholder?: string, default?: string}>
     */
    public function credentialFields(): array;

    /**
     * Optional capability metadata can be exposed by also implementing
     * HasIntegrationCapabilities. Hosts and catalog builders use it to
     * distinguish CLI setup support, web-only OAuth, runtime requirements,
     * and SEO/help text from simple credential-field inference.
     */
}
