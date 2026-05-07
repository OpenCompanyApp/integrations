<?php

namespace OpenCompany\Integrations\EndOfLifeDate;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the endoflife.date API v1.
 *
 * Handles endpoint routing, path segment encoding, permanent redirects, JSON
 * parsing, and API error normalization for lifecycle data lookups.
 */
class EndOfLifeDateService
{
    /**
     * @param  string  $baseUrl  endoflife.date API v1 base URL.
     */
    public function __construct(private string $baseUrl = 'https://endoflife.date/api/v1')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * List the main API endpoints.
     *
     * @return array<string, mixed>
     */
    public function index(): array
    {
        return $this->request('/');
    }

    /**
     * List all products with summary metadata.
     *
     * @return array<string, mixed>
     */
    public function products(): array
    {
        return $this->request('/products');
    }

    /**
     * List all products with full release lifecycle data.
     *
     * @return array<string, mixed>
     */
    public function productsFull(): array
    {
        return $this->request('/products/full');
    }

    /**
     * Get one product, including all known release cycles.
     *
     * @return array<string, mixed>
     */
    public function product(string $product): array
    {
        return $this->request('/products/'.$this->encode($product));
    }

    /**
     * Get one product release cycle.
     *
     * @return array<string, mixed>
     */
    public function productRelease(string $product, string $release): array
    {
        return $this->request('/products/'.$this->encode($product).'/releases/'.$this->encode($release));
    }

    /**
     * Get the latest release cycle for a product.
     *
     * @return array<string, mixed>
     */
    public function latestRelease(string $product): array
    {
        return $this->request('/products/'.$this->encode($product).'/releases/latest');
    }

    /**
     * List all categories.
     *
     * @return array<string, mixed>
     */
    public function categories(): array
    {
        return $this->request('/categories');
    }

    /**
     * List product summaries for a category.
     *
     * @return array<string, mixed>
     */
    public function categoryProducts(string $category): array
    {
        return $this->request('/categories/'.$this->encode($category));
    }

    /**
     * List all tags.
     *
     * @return array<string, mixed>
     */
    public function tags(): array
    {
        return $this->request('/tags');
    }

    /**
     * List product summaries for a tag.
     *
     * @return array<string, mixed>
     */
    public function tagProducts(string $tag): array
    {
        return $this->request('/tags/'.$this->encode($tag));
    }

    /**
     * List all identifier types, such as purl and cpe.
     *
     * @return array<string, mixed>
     */
    public function identifierTypes(): array
    {
        return $this->request('/identifiers');
    }

    /**
     * List all identifiers for a type and their related products.
     *
     * @return array<string, mixed>
     */
    public function identifiers(string $identifierType): array
    {
        return $this->request('/identifiers/'.$this->encode($identifierType));
    }

    /**
     * Execute an endoflife.date GET request.
     *
     * @return array<string, mixed>
     */
    private function request(string $path): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(60)
                ->withOptions(['allow_redirects' => true])
                ->get($this->baseUrl.$path);

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('endoflife.date API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to endoflife.date API: '.$e->getMessage());
        }
    }

    /**
     * Parse JSON responses and normalize API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = is_array($json) ? ($json['message'] ?? $json['error'] ?? null) : null;
            if (!is_string($message) || $message === '') {
                $message = trim(strip_tags($response->body()));
            }
            $message = $message !== '' ? substr($message, 0, 300) : 'Unexpected API error.';

            Log::error('endoflife.date API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('endoflife.date API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    private function encode(string $value): string
    {
        return rawurlencode(trim($value));
    }
}
