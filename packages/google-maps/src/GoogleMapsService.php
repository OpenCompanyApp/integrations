<?php

namespace OpenCompany\Integrations\GoogleMaps;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Google Maps Platform REST APIs.
 *
 * Authentication uses an API key passed as a query parameter (key=...).
 * Base URL: https://maps.googleapis.com/maps/api
 */
class GoogleMapsService
{
    /**
     * Create a new Google Maps service instance.
     *
     * @param  string  $apiKey  API key for Google Maps authentication (passed as key query param).
     * @param  string  $baseUrl  Base URL for the Google Maps API (default: https://maps.googleapis.com/maps/api).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://maps.googleapis.com/maps/api',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Geocode an address to coordinates and place details.
     *
     * @param  string  $address  The street address to geocode (e.g., "1600 Amphitheatre Parkway, Mountain View, CA").
     * @param  array<string, mixed>  $components  Optional address components filter (e.g., ['country' => 'US']).
     * @param  string|null  $region  Optional region bias (e.g., "us").
     * @param  string|null  $language  Optional language for results (e.g., "en").
     * @return array<string, mixed> Geocoding results.
     *
     * @see https://developers.google.com/maps/documentation/geocoding/requests-geocoding
     */
    public function geocodeAddress(string $address, array $components = [], ?string $region = null, ?string $language = null): array
    {
        $params = ['address' => $address];

        if (!empty($components)) {
            $parts = [];
            foreach ($components as $key => $value) {
                $parts[] = "{$key}:{$value}";
            }
            $params['components'] = implode('|', $parts);
        }

        if ($region !== null) {
            $params['region'] = $region;
        }

        if ($language !== null) {
            $params['language'] = $language;
        }

        return $this->request('GET', '/geocode/json', $params);
    }

    /**
     * Reverse geocode coordinates to an address.
     *
     * @param  float  $latitude  The latitude coordinate.
     * @param  float  $longitude  The longitude coordinate.
     * @param  array<string, mixed>  $components  Optional address components filter.
     * @param  string|null  $language  Optional language for results.
     * @param  string|null  $resultType  Optional result type filter (e.g., "street_address").
     * @param  string|null  $locationType  Optional location type filter (e.g., "ROOFTOP").
     * @return array<string, mixed> Reverse geocoding results.
     *
     * @see https://developers.google.com/maps/documentation/geocoding/requests-reverse-geocoding
     */
    public function reverseGeocode(float $latitude, float $longitude, array $components = [], ?string $language = null, ?string $resultType = null, ?string $locationType = null): array
    {
        $params = ['latlng' => "{$latitude},{$longitude}"];

        if (!empty($components)) {
            $parts = [];
            foreach ($components as $key => $value) {
                $parts[] = "{$key}:{$value}";
            }
            $params['components'] = implode('|', $parts);
        }

        if ($language !== null) {
            $params['language'] = $language;
        }

        if ($resultType !== null) {
            $params['result_type'] = $resultType;
        }

        if ($locationType !== null) {
            $params['location_type'] = $locationType;
        }

        return $this->request('GET', '/geocode/json', $params);
    }

    /**
     * Search for places using a text query or nearby search.
     *
     * @param  string  $query  The text search query (e.g., "restaurants in Sydney").
     * @param  string|null  $location  Optional location bias as "lat,lng" (e.g., "-33.867,151.195").
     * @param  float|null  $radius  Optional radius in meters for nearby search.
     * @param  string|null  $language  Optional language for results.
     * @param  string|null  $type  Optional place type filter (e.g., "restaurant", "hospital").
     * @param  bool  $openNow  Whether to filter for places that are currently open.
     * @param  int|null  $minPrice  Optional minimum price level (0-4).
     * @param  int|null  $maxPrice  Optional maximum price level (0-4).
     * @return array<string, mixed> Place search results.
     *
     * @see https://developers.google.com/maps/documentation/places/web-service/search-text
     */
    public function searchPlaces(string $query, ?string $location = null, ?float $radius = null, ?string $language = null, ?string $type = null, bool $openNow = false, ?int $minPrice = null, ?int $maxPrice = null): array
    {
        $params = ['query' => $query];

        if ($location !== null) {
            $params['location'] = $location;
        }

        if ($radius !== null) {
            $params['radius'] = $radius;
        }

        if ($language !== null) {
            $params['language'] = $language;
        }

        if ($type !== null) {
            $params['type'] = $type;
        }

        if ($openNow) {
            $params['opennow'] = 'true';
        }

        if ($minPrice !== null) {
            $params['minprice'] = $minPrice;
        }

        if ($maxPrice !== null) {
            $params['maxprice'] = $maxPrice;
        }

        return $this->request('GET', '/place/textsearch/json', $params);
    }

    /**
     * Get detailed information about a specific place.
     *
     * @param  string  $placeId  The Google Place ID (e.g., "ChIJN1t_tDeuEmsRUsoyG83frY4").
     * @param  array<string>  $fields  Optional fields to include (e.g., ['name', 'formatted_address', 'geometry']).
     * @param  string|null  $language  Optional language for results.
     * @param  string|null  $region  Optional region code.
     * @param  string|null  $reviewsNoTranslation  Set to "true" to disable review translations.
     * @param  string|null  $reviewsSort  Sorting for reviews (e.g., "most_relevant", "newest").
     * @return array<string, mixed> Place details.
     *
     * @see https://developers.google.com/maps/documentation/places/web-service/details
     */
    public function getPlaceDetails(string $placeId, array $fields = [], ?string $language = null, ?string $region = null, ?string $reviewsNoTranslation = null, ?string $reviewsSort = null): array
    {
        $params = ['place_id' => $placeId];

        if (!empty($fields)) {
            $params['fields'] = implode(',', $fields);
        }

        if ($language !== null) {
            $params['language'] = $language;
        }

        if ($region !== null) {
            $params['region'] = $region;
        }

        if ($reviewsNoTranslation !== null) {
            $params['reviews_no_translations'] = $reviewsNoTranslation;
        }

        if ($reviewsSort !== null) {
            $params['reviews_sort'] = $reviewsSort;
        }

        return $this->request('GET', '/place/details/json', $params);
    }

    /**
     * Get directions between an origin and destination.
     *
     * @param  string  $origin  The starting point (address, place ID, or "lat,lng").
     * @param  string  $destination  The end point (address, place ID, or "lat,lng").
     * @param  string|null  $mode  Travel mode: "driving", "walking", "bicycling", "transit".
     * @param  string|null  $waypoints  Optional waypoints (pipe-separated, e.g., "via:-37.81223,144.96253").
     * @param  bool  $alternatives  Whether to return alternative routes.
     * @param  array<string>  $avoid  Things to avoid (e.g., ["tolls", "highways", "ferries"]).
     * @param  string|null  $language  Optional language for results.
     * @param  string|null  $units  Unit system: "metric" or "imperial".
     * @param  string|null  $departureTime  Desired departure time ("now" or Unix timestamp).
     * @param  string|null  $arrivalTime  Desired arrival time (Unix timestamp, transit only).
     * @param  string|null  $transitMode  Transit modes: "bus", "subway", "train", "tram", "rail" (pipe-separated).
     * @param  string|null  $transitRoutingPreference  Transit routing preference: "less_walking" or "fewer_transfers".
     * @return array<string, mixed> Directions results.
     *
     * @see https://developers.google.com/maps/documentation/directions/requests-directions
     */
    public function getDirections(string $origin, string $destination, ?string $mode = null, ?string $waypoints = null, bool $alternatives = false, array $avoid = [], ?string $language = null, ?string $units = null, ?string $departureTime = null, ?string $arrivalTime = null, ?string $transitMode = null, ?string $transitRoutingPreference = null): array
    {
        $params = [
            'origin' => $origin,
            'destination' => $destination,
        ];

        if ($mode !== null) {
            $params['mode'] = $mode;
        }

        if ($waypoints !== null) {
            $params['waypoints'] = $waypoints;
        }

        if ($alternatives) {
            $params['alternatives'] = 'true';
        }

        if (!empty($avoid)) {
            $params['avoid'] = implode('|', $avoid);
        }

        if ($language !== null) {
            $params['language'] = $language;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($departureTime !== null) {
            $params['departure_time'] = $departureTime;
        }

        if ($arrivalTime !== null) {
            $params['arrival_time'] = $arrivalTime;
        }

        if ($transitMode !== null) {
            $params['transit_mode'] = $transitMode;
        }

        if ($transitRoutingPreference !== null) {
            $params['transit_routing_preference'] = $transitRoutingPreference;
        }

        return $this->request('GET', '/directions/json', $params);
    }

    /**
     * Get a distance matrix for multiple origins and destinations.
     *
     * @param  array<string>  $origins  Array of origin addresses or "lat,lng" strings.
     * @param  array<string>  $destinations  Array of destination addresses or "lat,lng" strings.
     * @param  string|null  $mode  Travel mode: "driving", "walking", "bicycling", "transit".
     * @param  string|null  $language  Optional language for results.
     * @param  string|null  $units  Unit system: "metric" or "imperial".
     * @param  string|null  $departureTime  Desired departure time ("now" or Unix timestamp).
     * @param  string|null  $arrivalTime  Desired arrival time (Unix timestamp, transit only).
     * @param  array<string>  $avoid  Things to avoid (e.g., ["tolls", "highways", "ferries"]).
     * @param  string|null  $transitMode  Transit modes (pipe-separated).
     * @param  string|null  $transitRoutingPreference  Transit routing preference.
     * @return array<string, mixed> Distance matrix results.
     *
     * @see https://developers.google.com/maps/documentation/distance-matrix/requests-distance-matrix
     */
    public function getDistanceMatrix(array $origins, array $destinations, ?string $mode = null, ?string $language = null, ?string $units = null, ?string $departureTime = null, ?string $arrivalTime = null, array $avoid = [], ?string $transitMode = null, ?string $transitRoutingPreference = null): array
    {
        $params = [
            'origins' => implode('|', $origins),
            'destinations' => implode('|', $destinations),
        ];

        if ($mode !== null) {
            $params['mode'] = $mode;
        }

        if ($language !== null) {
            $params['language'] = $language;
        }

        if ($units !== null) {
            $params['units'] = $units;
        }

        if ($departureTime !== null) {
            $params['departure_time'] = $departureTime;
        }

        if ($arrivalTime !== null) {
            $params['arrival_time'] = $arrivalTime;
        }

        if (!empty($avoid)) {
            $params['avoid'] = implode('|', $avoid);
        }

        if ($transitMode !== null) {
            $params['transit_mode'] = $transitMode;
        }

        if ($transitRoutingPreference !== null) {
            $params['transit_routing_preference'] = $transitRoutingPreference;
        }

        return $this->request('GET', '/distancematrix/json', $params);
    }

    /**
     * Get geolocation data for the current requesting IP address.
     *
     * Uses the Geolocation API to estimate the caller's position based on
     * network infrastructure data.
     *
     * @return array<string, mixed> Geolocation data for the current user.
     *
     * @see https://developers.google.com/maps/documentation/geolocation/requests-geolocation
     */
    public function getCurrentUser(): array
    {
        return $this->request('POST', '/geolocation/json', [], [
            'considerIp' => true,
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path (e.g., "/geocode/json").
     * @param  array<string, mixed>  $params  Query parameters.
     * @param  array<string, mixed>  $body  JSON body for POST requests.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $params = [], array $body = []): array
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Google Maps API key is not configured.');
        }

        // Google Maps uses key as a query parameter
        $params['key'] = $this->apiKey;

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->withQueryParameters($params)->post($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json();
                $message = $body['error_message'] ?? $body['status'] ?? $response->body();

                Log::error('Google Maps API error', [
                    'method' => $method,
                    'path' => $path,
                    'status' => $response->status(),
                    'body' => $body,
                ]);

                throw new \RuntimeException("Google Maps API error ({$response->status()}): {$message}");
            }

            $json = $response->json() ?? [];

            // Google Maps may return errors in a 200 response with status != "OK" / "ZERO_RESULTS"
            $status = $json['status'] ?? 'UNKNOWN';
            if (isset($json['error_message']) && $status !== 'OK' && $status !== 'ZERO_RESULTS') {
                throw new \RuntimeException("Google Maps API error ({$status}): {$json['error_message']}");
            }

            return $json;
        } catch (ConnectionException $e) {
            Log::error('Google Maps connection error', ['method' => $method, 'path' => $path, 'error' => $e->getMessage()]);
            throw new \RuntimeException("Google Maps connection error: {$e->getMessage()}");
        }
    }
}
