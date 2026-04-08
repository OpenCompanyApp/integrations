<?php

namespace OpenCompany\Integrations\Nasa;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Nasa\Tools\NasaGetApod;
use OpenCompany\Integrations\Nasa\Tools\NasaGetMarsRoverPhotos;
use OpenCompany\Integrations\Nasa\Tools\NasaGetAsteroids;
use OpenCompany\Integrations\Nasa\Tools\NasaGetAsteroid;
use OpenCompany\Integrations\Nasa\Tools\NasaSearchImages;
use OpenCompany\Integrations\Nasa\Tools\NasaGetCurrentUser;

class NasaToolProvider implements ToolProvider
{
    /**
     * Get the application name used for registration.
     */
    public function appName(): string
    {
        return 'nasa';
    }

    /**
     * Get metadata for the tool provider UI.
     *
     * @return array<string, mixed> UI metadata.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'apod, mars, asteroids, images',
            'description' => 'NASA space and science data',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:nasa',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'nasa_get_apod' => [
                'class' => NasaGetApod::class,
                'type' => 'read',
                'name' => 'Get APOD',
                'description' => 'Get the Astronomy Picture of the Day from NASA.',
                'icon' => 'ph:star-four',
            ],
            'nasa_get_mars_rover_photos' => [
                'class' => NasaGetMarsRoverPhotos::class,
                'type' => 'read',
                'name' => 'Mars Rover Photos',
                'description' => 'Get photos from Mars rovers (Curiosity, Opportunity, Spirit, Perseverance).',
                'icon' => 'ph:camera',
            ],
            'nasa_get_asteroids' => [
                'class' => NasaGetAsteroids::class,
                'type' => 'read',
                'name' => 'Get Asteroids',
                'description' => 'Get Near Earth Objects (asteroids) for a date range.',
                'icon' => 'ph:planet',
            ],
            'nasa_get_asteroid' => [
                'class' => NasaGetAsteroid::class,
                'type' => 'read',
                'name' => 'Get Asteroid',
                'description' => 'Get details for a specific asteroid by its NASA ID.',
                'icon' => 'ph:planet',
            ],
            'nasa_search_images' => [
                'class' => NasaSearchImages::class,
                'type' => 'read',
                'name' => 'Search Images',
                'description' => 'Search the NASA Image and Video Library.',
                'icon' => 'ph:magnifying-glass',
            ],
            'nasa_get_current_user' => [
                'class' => NasaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Return info about the current NASA API configuration.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/nasa.md';
    }

    /**
     * Create a tool instance.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context (unused for public API).
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(NasaService::class));
    }
}
