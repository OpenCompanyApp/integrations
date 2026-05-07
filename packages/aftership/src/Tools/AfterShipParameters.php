<?php

namespace OpenCompany\Integrations\AfterShip\Tools;

/**
 * Parameter schemas shared by AfterShip tool classes.
 *
 * Keeps tool metadata compact while documenting the high-use Tracking API
 * payload and filter fields agents need for first-pass calls.
 */
class AfterShipParameters
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function listTrackings(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum trackings to return.'],
            'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number when supported.'],
            'cursor' => ['type' => 'string', 'required' => false, 'description' => 'Cursor from a previous list response.'],
            'slug' => ['type' => 'string', 'required' => false, 'description' => 'Courier slug filter.'],
            'tracking_numbers' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated tracking numbers.'],
            'delivery_status' => ['type' => 'string', 'required' => false, 'description' => 'Delivery status filter such as Pending, InfoReceived, InTransit, OutForDelivery, AttemptFail, Delivered, AvailableForPickup, Exception, or Expired.'],
            'tag' => ['type' => 'string', 'required' => false, 'description' => 'Tracking tag filter.'],
            'created_at_min' => ['type' => 'string', 'required' => false, 'description' => 'Minimum created-at timestamp.'],
            'created_at_max' => ['type' => 'string', 'required' => false, 'description' => 'Maximum created-at timestamp.'],
            'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields to include.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function tracking(bool $requireNumber = true): array
    {
        return [
            'tracking' => ['type' => 'object', 'required' => false, 'description' => 'Full AfterShip tracking object. If omitted, top-level fields are wrapped as tracking.'],
            'tracking_number' => ['type' => 'string', 'required' => $requireNumber, 'description' => 'Shipment tracking number.'],
            'slug' => ['type' => 'string', 'required' => false, 'description' => 'Courier slug such as fedex, ups, usps, or dhl.'],
            'title' => ['type' => 'string', 'required' => false, 'description' => 'Display title, often an order number.'],
            'order_id' => ['type' => 'string', 'required' => false, 'description' => 'Globally unique order identifier.'],
            'order_number' => ['type' => 'string', 'required' => false, 'description' => 'Human-readable order number.'],
            'custom_fields' => ['type' => 'object', 'required' => false, 'description' => 'Custom string fields. Do not include private customer data in tests or docs.'],
            'language' => ['type' => 'string', 'required' => false, 'description' => 'Recipient language code for notifications.'],
            'origin_country_region' => ['type' => 'string', 'required' => false, 'description' => 'Origin ISO alpha-3 country/region code.'],
            'destination_country_region' => ['type' => 'string', 'required' => false, 'description' => 'Destination ISO alpha-3 country/region code.'],
            'destination_postal_code' => ['type' => 'string', 'required' => false, 'description' => 'Destination postal code.'],
            'shipment_tags' => ['type' => 'array', 'required' => false, 'description' => 'Tags used to categorize shipments.', 'items' => ['type' => 'string']],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function id(): array
    {
        return ['id' => ['type' => 'string', 'required' => true, 'description' => 'AfterShip resource ID.']];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function detectCourier(): array
    {
        return self::tracking(true);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function courierConnections(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum connections to return.'],
            'cursor' => ['type' => 'string', 'required' => false, 'description' => 'Cursor from a previous response.'],
            'slug' => ['type' => 'string', 'required' => false, 'description' => 'Courier slug filter.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function payload(string $description): array
    {
        return [
            'id' => ['type' => 'string', 'required' => false, 'description' => 'Resource ID when updating path-scoped endpoints.'],
            'payload' => ['type' => 'object', 'required' => false, 'description' => $description],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function edd(): array
    {
        return [
            'slug' => ['type' => 'string', 'required' => false, 'description' => 'Courier slug.'],
            'origin_country_region' => ['type' => 'string', 'required' => false, 'description' => 'Origin ISO alpha-3 country/region code.'],
            'origin_postal_code' => ['type' => 'string', 'required' => false, 'description' => 'Origin postal code.'],
            'destination_country_region' => ['type' => 'string', 'required' => false, 'description' => 'Destination ISO alpha-3 country/region code.'],
            'destination_postal_code' => ['type' => 'string', 'required' => false, 'description' => 'Destination postal code.'],
            'order_date' => ['type' => 'string', 'required' => false, 'description' => 'Order date or ship date used for EDD prediction.'],
            'raw' => ['type' => 'object', 'required' => false, 'description' => 'Full EDD payload. If present, it is sent as provided.'],
        ];
    }
}
