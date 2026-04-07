<?php

namespace OpenCompany\Integrations\Firebase;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseService
{
    private string $managementBaseUrl;
    private string $firestoreBaseUrl;

    /**
     * Create a new Firebase service instance.
     *
     * @param string $accessToken The OAuth2 access token (sent as Bearer token).
     * @param string $projectId   The Firebase/Google Cloud project ID.
     * @param string $baseUrl     The Firebase Management API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $projectId = '',
        string $baseUrl = 'https://firebase.googleapis.com/v1',
    ) {
        $this->managementBaseUrl = rtrim($baseUrl, '/');
        $this->firestoreBaseUrl = 'https://firestore.googleapis.com/v1';
    }

    /**
     * Check whether the service is properly configured.
     *
     * @return bool True if the access token is set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all Firebase projects the caller has access to.
     *
     * @param  array $params Query parameters: pageSize, pageToken.
     * @return array The parsed JSON response containing projects.
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', $this->managementBaseUrl . '/projects', $params);
    }

    /**
     * Get a Firebase project by its resource name.
     *
     * @param  string $name The project resource name (e.g. "projects/my-project").
     * @return array The parsed JSON response containing the project.
     */
    public function getProject(string $name): array
    {
        return $this->request('GET', $this->managementBaseUrl . '/' . ltrim($name, '/'));
    }

    /**
     * List Cloud Firestore databases in a project.
     *
     * @param  string $parent The parent project (e.g. "projects/my-project").
     * @return array The parsed JSON response containing databases.
     */
    public function listDatabases(string $parent): array
    {
        return $this->request('GET', $this->firestoreBaseUrl . '/' . ltrim($parent, '/') . '/databases');
    }

    /**
     * List documents in a Firestore collection.
     *
     * @param  string $parent The parent document or database (e.g. "projects/my-project/databases/(default)/documents").
     * @param  string $collectionId The collection ID to list documents from.
     * @param  array  $params Query parameters: pageSize, pageToken, orderBy, mask.fieldPaths.
     * @return array The parsed JSON response containing documents.
     */
    public function listDocuments(string $parent, string $collectionId, array $params = []): array
    {
        return $this->request('GET', $this->firestoreBaseUrl . '/' . ltrim($parent, '/') . '/' . urlencode($collectionId), $params);
    }

    /**
     * List collection IDs under a document or database.
     *
     * @param  string $parent The parent document or database (e.g. "projects/my-project/databases/(default)/documents").
     * @param  array  $data   Request body: pageSize, pageToken.
     * @return array The parsed JSON response containing collection IDs.
     */
    public function listCollections(string $parent, array $data = []): array
    {
        return $this->request('POST', $this->firestoreBaseUrl . '/' . ltrim($parent, '/') . ':listCollectionIds', $data);
    }

    /**
     * List users in a Firebase project via Identity Toolkit.
     *
     * @param  array $params Query parameters: maxResults, nextPageToken.
     * @return array The parsed JSON response containing users.
     */
    public function listUsers(array $params = []): array
    {
        $url = "https://identitytoolkit.googleapis.com/v1/projects/{$this->projectId}/accounts";
        return $this->request('GET', $url, $params);
    }

    /**
     * Get the currently authenticated user info from the OAuth2 token.
     *
     * @return array The parsed JSON response containing user info.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', 'https://www.googleapis.com/oauth2/v3/userinfo');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param  string $url    The full API URL.
     * @param  array  $data   Request data (query params for GET, body for POST).
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $url, array $data = []): array
    {
        $response = $this->rawRequest($method, $url, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to a Firebase API.
     *
     * @param  string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param  string $url    The full API URL.
     * @param  array  $data   Request data (query params for GET, body for POST).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $url, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Firebase access token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['error']['message'] ?? $json['message'] ?? $response->body();

                Log::error("Firebase API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);

                throw new \RuntimeException(
                    "Firebase API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Firebase API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Firebase API: {$e->getMessage()}");
        }
    }
}
