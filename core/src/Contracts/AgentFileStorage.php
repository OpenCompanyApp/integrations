<?php

namespace OpenCompany\IntegrationCore\Contracts;

/**
 * Allows vendor tool packages to save files into the workspace file system
 * without coupling to the host application's models or services.
 */
interface AgentFileStorage
{
    /**
     * Save binary or text content as a workspace file under the agent's home folder.
     *
     * @param  object  $agent      The agent object (passed through from tool context)
     * @param  string  $filename   Target filename (e.g., "diagram.png")
     * @param  string  $content    Raw file content (binary safe)
     * @param  string  $mimeType   MIME type (e.g., "image/png")
     * @param  string|null  $subfolder  Optional subfolder under agent home (e.g., "mermaid")
     * @return array{id: string, path: string, url: string}
     */
    public function saveFile(
        object $agent,
        string $filename,
        string $content,
        string $mimeType,
        ?string $subfolder = null,
    ): array;
}
