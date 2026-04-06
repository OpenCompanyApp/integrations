<?php

namespace OpenCompany\Integrations\GoogleSlides;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleSlidesService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://slides.googleapis.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List presentations from the user's Google Drive.
     *
     * Uses the Google Drive API to list presentation files, since the Slides API
     * does not have a native list endpoint. Returns files of type
     * `application/vnd.google-apps.presentation`.
     *
     * @param  int  $pageSize  Maximum number of presentations to return per page (default: 20, max: 100).
     * @param  string|null  $pageToken  Token for the next page of results.
     * @return array<string, mixed>
     */
    public function listPresentations(int $pageSize = 20, ?string $pageToken = null): array
    {
        $params = [
            'pageSize' => min($pageSize, 100),
            'q' => "mimeType='application/vnd.google-apps.presentation'",
            'fields' => 'nextPageToken,files(id,name,createdTime,modifiedTime,thumbnailLink,webViewLink)',
        ];

        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', 'https://www.googleapis.com/drive/v3/files', $params);
    }

    /**
     * Get a presentation by ID.
     *
     * @param  string  $id  The presentation ID.
     * @return array<string, mixed>
     */
    public function getPresentation(string $id): array
    {
        return $this->request('GET', $this->baseUrl . '/v1/presentations/' . urlencode($id));
    }

    /**
     * Create a new presentation.
     *
     * @param  string  $title  The title of the new presentation.
     * @return array<string, mixed>
     */
    public function createPresentation(string $title): array
    {
        return $this->request('POST', $this->baseUrl . '/v1/presentations', [
            'title' => $title,
        ]);
    }

    /**
     * List slides in a presentation.
     *
     * @param  string  $id  The presentation ID.
     * @param  int  $pageSize  Maximum number of slides to return per page.
     * @param  string|null  $pageToken  Token for the next page of results.
     * @return array<string, mixed>
     */
    public function listSlides(string $id, int $pageSize = 20, ?string $pageToken = null): array
    {
        $params = [];

        if ($pageSize) {
            $params['pageSize'] = $pageSize;
        }

        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', $this->baseUrl . '/v1/presentations/' . urlencode($id) . '/slides', $params);
    }

    /**
     * Get a specific slide (page) from a presentation.
     *
     * @param  string  $id  The presentation ID.
     * @param  string  $page  The page (slide) object ID.
     * @param  string|null  $objectIdField  The field to use for object ID resolution.
     * @return array<string, mixed>
     */
    public function getSlide(string $id, string $page, ?string $objectIdField = null): array
    {
        $params = [];

        if ($objectIdField) {
            $params['objectIdField'] = $objectIdField;
        }

        return $this->request('GET', $this->baseUrl . '/v1/presentations/' . urlencode($id) . '/slides/' . urlencode($page), $params);
    }

    /**
     * Create a new slide in a presentation using batchUpdate.
     *
     * @param  string  $id  The presentation ID.
     * @param  string|null  $pageObjectId  Optional object ID for the new slide.
     * @param  bool  $createObject  Whether to create the slide object (default: true).
     * @param  array<string, mixed>  $slide  Slide definition with optional elements.
     * @return array<string, mixed>
     */
    public function createSlide(string $id, ?string $pageObjectId = null, bool $createObject = true, array $slide = []): array
    {
        $requests = [];

        // Build the create slide request
        $createSlideRequest = [
            'insertSlide' => [],
        ];

        if ($pageObjectId) {
            $createSlideRequest['insertSlide']['objectId'] = $pageObjectId;
        }

        $requests[] = $createSlideRequest;

        // Add elements (text boxes, shapes) to the new slide
        $elements = $slide['elements'] ?? [];
        $slideObjectId = $pageObjectId ?? '';

        foreach ($elements as $index => $element) {
            $elementObjectId = $slideObjectId . '_element_' . $index;
            $type = $element['type'] ?? 'text';
            $text = $element['text'] ?? '';
            $style = $element['style'] ?? [];

            if ($type === 'text' || $type === 'shape') {
                // Create a shape (text box) on the slide
                $createShapeRequest = [
                    'createShape' => [
                        'objectId' => $elementObjectId,
                        'shapeType' => ($type === 'text') ? 'TEXT_BOX' : ($element['shape'] ?? 'RECTANGLE'),
                        'elementProperties' => [
                            'pageObjectId' => $slideObjectId,
                            'size' => $style['size'] ?? [
                                'height' => ['magnitude' => 3000000, 'unit' => 'EMU'],
                                'width' => ['magnitude' => 6000000, 'unit' => 'EMU'],
                            ],
                            'transform' => $style['transform'] ?? [
                                'scaleX' => 1,
                                'scaleY' => 1,
                                'translateX' => 100000,
                                'translateY' => 100000,
                                'unit' => 'EMU',
                            ],
                        ],
                    ],
                ];

                $requests[] = $createShapeRequest;

                // Insert text into the shape
                if (!empty($text)) {
                    $insertTextRequest = [
                        'insertText' => [
                            'objectId' => $elementObjectId,
                            'text' => $text,
                            'insertionIndex' => 0,
                        ],
                    ];

                    if (isset($style['font'])) {
                        $insertTextRequest['insertText']['fields'] = '*';
                    }

                    $requests[] = $insertTextRequest;
                }
            }
        }

        return $this->request('POST', $this->baseUrl . '/v1/presentations/' . urlencode($id) . ':batchUpdate', [
            'requests' => $requests,
        ]);
    }

    /**
     * Get the current authenticated user's profile information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', 'https://www.googleapis.com/drive/v3/about', [
            'fields' => 'user(displayName,emailAddress,photoLink)',
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $url  Full URL for the request.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $url, array $data = []): array
    {
        $response = $this->rawRequest($method, $url, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Google Slides/Drive API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $url  Full URL for the request.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $url, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Google Slides access token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->body();
                Log::error("Google Slides API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Google Slides API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Slides API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Slides API: {$e->getMessage()}");
        }
    }
}
