<?php

namespace OpenCompany\Integrations\OpenStreetMap\Tools;

/**
 * Parameter schemas shared by OpenStreetMap tool classes.
 *
 * Captures common Nominatim output options, polygon flags, and OSM object
 * identifiers without duplicating large arrays in every tool.
 */
class OpenStreetMapParameters
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function search(): array
    {
        return [
            'q' => ['type' => 'string', 'required' => false, 'description' => 'Free-form search query. Required unless structured address fields are provided.'],
            'street' => ['type' => 'string', 'required' => false, 'description' => 'Structured street address.'],
            'city' => ['type' => 'string', 'required' => false, 'description' => 'Structured city.'],
            'county' => ['type' => 'string', 'required' => false, 'description' => 'Structured county.'],
            'state' => ['type' => 'string', 'required' => false, 'description' => 'Structured state.'],
            'country' => ['type' => 'string', 'required' => false, 'description' => 'Structured country.'],
            'postalcode' => ['type' => 'string', 'required' => false, 'description' => 'Structured postal code.'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of results.'],
            'viewbox' => ['type' => 'string', 'required' => false, 'description' => 'Preferred result bounding box as left,top,right,bottom.'],
            'bounded' => self::bool('Restrict results to viewbox.'),
            'countrycodes' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated country code filter.'],
            'exclude_place_ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated Nominatim place IDs to exclude.'],
            'dedupe' => self::bool('Remove duplicate results.'),
        ] + self::nominatimCommon();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function reverse(): array
    {
        return [
            'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude in WGS84.'],
            'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude in WGS84.'],
            'zoom' => ['type' => 'integer', 'required' => false, 'description' => 'Address detail zoom level from 0 to 18.'],
            'layer' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated layers: address, poi, railway, natural, manmade.'],
        ] + self::nominatimCommon();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function lookup(): array
    {
        return [
            'osm_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated OSM object IDs with type prefix, such as N123,W456,R789.'],
        ] + self::nominatimCommon();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function details(): array
    {
        return [
            'place_id' => ['type' => 'integer', 'required' => false, 'description' => 'Nominatim place ID. Required unless osmtype and osmid are provided.'],
            'osmtype' => ['type' => 'string', 'required' => false, 'description' => 'OSM type letter N, W, or R. Required with osmid when place_id is absent.'],
            'osmid' => ['type' => 'integer', 'required' => false, 'description' => 'OSM object ID. Required with osmtype when place_id is absent.'],
            'class' => ['type' => 'string', 'required' => false, 'description' => 'Optional OSM class used with osmtype/osmid.'],
            'addressdetails' => self::bool('Include address details.'),
            'keywords' => self::bool('Include search keywords.'),
            'linkedplaces' => self::bool('Include linked places.'),
            'hierarchy' => self::bool('Include place hierarchy.'),
            'group_hierarchy' => self::bool('Group hierarchy output.'),
            'polygon_geojson' => self::bool('Include GeoJSON geometry.'),
            'accept-language' => ['type' => 'string', 'required' => false, 'description' => 'Preferred response language order.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function status(): array
    {
        return ['format' => ['type' => 'string', 'required' => false, 'description' => 'Output format. Defaults to json.', 'enum' => ['json', 'text']]];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function overpassQuery(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Overpass QL query. Include an output mode such as [out:json] for JSON responses.'],
            'method' => ['type' => 'string', 'required' => false, 'description' => 'HTTP method. Defaults to post.', 'enum' => ['get', 'post']],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function objectUrl(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'OSM object type.', 'enum' => ['node', 'way', 'relation']],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Positive OSM object ID.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function mapUrl(): array
    {
        return [
            'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
            'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
            'zoom' => ['type' => 'integer', 'required' => false, 'description' => 'Map zoom level. Defaults to 18.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    private static function nominatimCommon(): array
    {
        return [
            'format' => ['type' => 'string', 'required' => false, 'description' => 'Output format. Defaults to jsonv2.', 'enum' => ['json', 'jsonv2', 'geojson', 'geocodejson']],
            'addressdetails' => self::bool('Include address breakdown.'),
            'extratags' => self::bool('Include extra OSM tags such as wikipedia or opening_hours.'),
            'namedetails' => self::bool('Include full name variants.'),
            'accept-language' => ['type' => 'string', 'required' => false, 'description' => 'Preferred response language order.'],
            'polygon_geojson' => self::bool('Include GeoJSON geometry.'),
            'polygon_kml' => self::bool('Include KML geometry.'),
            'polygon_svg' => self::bool('Include SVG geometry.'),
            'polygon_text' => self::bool('Include WKT geometry.'),
            'polygon_threshold' => ['type' => 'number', 'required' => false, 'description' => 'Geometry simplification tolerance in degrees.'],
            'email' => ['type' => 'string', 'required' => false, 'description' => 'Contact email for high-volume Nominatim usage.'],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private static function bool(string $description): array
    {
        return ['type' => 'boolean', 'required' => false, 'description' => $description];
    }
}
