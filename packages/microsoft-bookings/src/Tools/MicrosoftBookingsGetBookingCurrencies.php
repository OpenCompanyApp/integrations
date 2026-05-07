<?php

namespace OpenCompany\Integrations\MicrosoftBookings\Tools;

/**
 * Get bookingCurrency.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /solutions/bookingCurrencies/{bookingCurrency-id}.
 */
class MicrosoftBookingsGetBookingCurrencies extends AbstractMicrosoftBookingsTool
{
    protected const NAME = 'microsoft_bookings_get_booking_currencies';
    protected const DESCRIPTION = 'Get bookingCurrency\n\nOfficial Microsoft Graph v1.0 endpoint: GET /solutions/bookingCurrencies/{bookingCurrency-id}.';
    protected const PARAMETERS = ['booking_currency_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `bookingCurrency-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/solutions/bookingCurrencies/{bookingCurrency-id}';
    protected const PATH_PARAMS = ['bookingCurrency-id' => 'booking_currency_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
