<?php

namespace OpenCompany\Integrations\Dropbox;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Dropbox API v2.
 *
 * Provides methods for file/folder operations, search, sharing,
 * revisions, and account management via the Dropbox RPC-style API.
 *
 * Dropbox API v2 uses POST requests with JSON bodies for all operations.
 * Upload and download use the content endpoint with special header handling.
 */
class DropboxService
{
    private const RPC_URL = 'https://api.dropboxapi.com/2';

    private const CONTENT_URL = 'https://content.dropboxapi.com/2';

    /**
     * @param  string  $accessToken  Dropbox OAuth2 access token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    /**
     * Check whether the Dropbox access token has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    /*-----------------------------------------------------------------------
     | RPC Requests
     *---------------------------------------------------------------------*/

    /**
     * Send an RPC-style POST request to the Dropbox API.
     *
     * All Dropbox API v2 calls are POST with a JSON body.
     *
     * @param  string               $endpoint  API endpoint path (e.g., 'files/list_folder')
     * @param  array<string, mixed> $params    JSON body parameters
     * @return array<string, mixed>
     */
    public function rpc(string $endpoint, array $params = []): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->accessToken}",
            'Content-Type' => 'application/json',
        ])->post(self::RPC_URL . "/{$endpoint}", empty($params) ? new \stdClass() : $params);

        $this->logErrorIfFailed($response, $endpoint);

        return $response->json() ?? [];
    }

    /**
     * Send a content POST request to the Dropbox Content API.
     *
     * Used for upload and download operations where the body is raw file content
     * and parameters are passed via the Dropbox-API-Arg header.
     *
     * @param  string               $endpoint  Content API endpoint path (e.g., 'files/upload')
     * @param  array<string, mixed> $params    Parameters sent via Dropbox-API-Arg header
     * @param  string               $body      Raw body content (file data for upload, empty for download)
     * @return array<string, mixed>
     */
    public function content(string $endpoint, array $params = [], string $body = ''): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->accessToken}",
            'Content-Type' => 'application/octet-stream',
            'Dropbox-API-Arg' => json_encode(empty($params) ? new \stdClass() : $params, JSON_UNESCAPED_SLASHES),
        ])->withBody($body, 'application/octet-stream')
          ->post(self::CONTENT_URL . "/{$endpoint}");

        $this->logErrorIfFailed($response, $endpoint);

        return $response->json() ?? [];
    }

    /**
     * Download a file from the Dropbox Content API.
     *
     * Returns the raw file content as a string. The API response includes
     * file metadata in the `Dropbox-API-Result` header.
     *
     * @param  string  $endpoint  Content API endpoint path (e.g., 'files/download')
     * @param  array<string, mixed>  $params  Parameters sent via Dropbox-API-Arg header
     * @return string  Raw file content
     */
    public function download(string $endpoint, array $params = []): string
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->accessToken}",
            'Content-Type' => '',
            'Dropbox-API-Arg' => json_encode(empty($params) ? new \stdClass() : $params, JSON_UNESCAPED_SLASHES),
        ])->post(self::CONTENT_URL . "/{$endpoint}");

        $this->logErrorIfFailed($response, $endpoint);

        return $response->body();
    }

    /*-----------------------------------------------------------------------
     | Files & Folders
     *---------------------------------------------------------------------*/

    /**
     * List files and folders in a Dropbox directory.
     *
     * @param  array<string, mixed>  $params  Parameters (path, recursive, limit)
     * @return array<string, mixed>
     */
    public function listFolder(array $params): array
    {
        return $this->rpc('files/list_folder', $params);
    }

    /**
     * Continue listing files and folders using a cursor from a previous list_folder call.
     *
     * @param  array<string, mixed>  $params  Parameters (cursor)
     * @return array<string, mixed>
     */
    public function listFolderContinue(array $params): array
    {
        return $this->rpc('files/list_folder/continue', $params);
    }

    /**
     * Upload a file to Dropbox via the content endpoint.
     *
     * @param  array<string, mixed>  $params  Parameters (path, mode, autorename, mute)
     * @param  string                $content  Raw file content to upload
     * @return array<string, mixed>
     */
    public function uploadFile(array $params, string $content): array
    {
        return $this->content('files/upload', $params, $content);
    }

    /**
     * Download a file from Dropbox via the content endpoint.
     *
     * @param  array<string, mixed>  $params  Parameters (path)
     * @return string  Raw file content
     */
    public function downloadFile(array $params): string
    {
        return $this->download('files/download', $params);
    }

    /**
     * Create a new folder in Dropbox.
     *
     * @param  array<string, mixed>  $params  Parameters (path, autorename)
     * @return array<string, mixed>
     */
    public function createFolder(array $params): array
    {
        return $this->rpc('files/create_folder_v2', $params);
    }

    /**
     * Delete a file or folder at a given path.
     *
     * @param  array<string, mixed>  $params  Parameters (path)
     * @return array<string, mixed>
     */
    public function delete(array $params): array
    {
        return $this->rpc('files/delete_v2', $params);
    }

    /**
     * Move a file or folder to a new location.
     *
     * @param  array<string, mixed>  $params  Parameters (from_path, to_path, autorename, allow_shared_folder)
     * @return array<string, mixed>
     */
    public function move(array $params): array
    {
        return $this->rpc('files/move_v2', $params);
    }

    /**
     * Copy a file or folder to a new location.
     *
     * @param  array<string, mixed>  $params  Parameters (from_path, to_path, autorename, allow_shared_folder)
     * @return array<string, mixed>
     */
    public function copy(array $params): array
    {
        return $this->rpc('files/copy_v2', $params);
    }

    /*-----------------------------------------------------------------------
     | Search
     *---------------------------------------------------------------------*/

    /**
     * Search for files and folders in Dropbox.
     *
     * @param  array<string, mixed>  $params  Parameters (query, path, file_categories, max_results)
     * @return array<string, mixed>
     */
    public function searchFiles(array $params): array
    {
        return $this->rpc('files/search_v2', $params);
    }

    /**
     * Continue a search using a cursor from a previous search call.
     *
     * @param  array<string, mixed>  $params  Parameters (cursor)
     * @return array<string, mixed>
     */
    public function searchContinue(array $params): array
    {
        return $this->rpc('files/search/continue_v2', $params);
    }

    /*-----------------------------------------------------------------------
     | Sharing
     *---------------------------------------------------------------------*/

    /**
     * Create a shared link for a file or folder.
     *
     * @param  array<string, mixed>  $params  Parameters (path, settings)
     * @return array<string, mixed>
     */
    public function createSharedLink(array $params): array
    {
        return $this->rpc('sharing/create_shared_link_with_settings', $params);
    }

    /**
     * List shared links for a file or folder.
     *
     * @param  array<string, mixed>  $params  Parameters (path, cursor)
     * @return array<string, mixed>
     */
    public function listSharedLinks(array $params): array
    {
        return $this->rpc('sharing/list_shared_links', $params);
    }

    /**
     * Get a temporary link to stream a file.
     *
     * @param  array<string, mixed>  $params  Parameters (path)
     * @return array<string, mixed>
     */
    public function getTemporaryLink(array $params): array
    {
        return $this->rpc('files/get_temporary_link', $params);
    }

    /*-----------------------------------------------------------------------
     | Revisions & Account
     *---------------------------------------------------------------------*/

    /**
     * List file revisions.
     *
     * @param  array<string, mixed>  $params  Parameters (path, limit)
     * @return array<string, mixed>
     */
    public function listRevisions(array $params): array
    {
        return $this->rpc('files/list_revisions', $params);
    }

    /**
     * Restore a file to a specific revision.
     *
     * @param  array<string, mixed>  $params  Parameters (path, rev)
     * @return array<string, mixed>
     */
    public function restore(array $params): array
    {
        return $this->rpc('files/restore', $params);
    }

    /**
     * Get metadata for a file or folder.
     *
     * @param  array<string, mixed>  $params  Parameters (path, include_media_info, include_deleted)
     * @return array<string, mixed>
     */
    public function getMetadata(array $params): array
    {
        return $this->rpc('files/get_metadata', $params);
    }

    /**
     * Get information about the currently authenticated user account.
     *
     * @return array<string, mixed>
     */
    public function getCurrentAccount(): array
    {
        return $this->rpc('users/get_current_account');
    }

    /*-----------------------------------------------------------------------
     | Internal
     *---------------------------------------------------------------------*/

    /**
     * Log a warning if the API response indicates a failure.
     *
     * @param  \Illuminate\Http\Client\Response  $response
     * @param  string  $endpoint
     */
    private function logErrorIfFailed($response, string $endpoint): void
    {
        if ($response->failed()) {
            Log::warning("Dropbox API error on {$endpoint}", [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }
    }
}
