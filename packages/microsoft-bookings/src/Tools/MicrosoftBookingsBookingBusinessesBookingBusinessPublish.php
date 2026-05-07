<?php

namespace OpenCompany\Integrations\MicrosoftBookings\Tools;

/**
 * Invoke action publish.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /solutions/bookingBusinesses/{bookingBusiness-id}/publish.
 */
class MicrosoftBookingsBookingBusinessesBookingBusinessPublish extends AbstractMicrosoftBookingsTool
{
    protected const NAME = 'microsoft_bookings_booking_businesses_booking_business_publish';
    protected const DESCRIPTION = 'Invoke action publish\n\nOfficial Microsoft Graph v1.0 endpoint: POST /solutions/bookingBusinesses/{bookingBusiness-id}/publish.';
    protected const PARAMETERS = ['booking_business_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `bookingBusiness-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'POST';
    protected const PATH = '/solutions/bookingBusinesses/{bookingBusiness-id}/publish';
    protected const PATH_PARAMS = ['bookingBusiness-id' => 'booking_business_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
