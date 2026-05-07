<?php

namespace OpenCompany\Integrations\MicrosoftBookings\Tools;

/**
 * List services.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /solutions/bookingBusinesses/{bookingBusiness-id}/services.
 */
class MicrosoftBookingsBookingBusinessesListServices extends AbstractMicrosoftBookingsTool
{
    protected const NAME = 'microsoft_bookings_booking_businesses_list_services';
    protected const DESCRIPTION = 'List services\n\nOfficial Microsoft Graph v1.0 endpoint: GET /solutions/bookingBusinesses/{bookingBusiness-id}/services.';
    protected const PARAMETERS = ['booking_business_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `bookingBusiness-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/solutions/bookingBusinesses/{bookingBusiness-id}/services';
    protected const PATH_PARAMS = ['bookingBusiness-id' => 'booking_business_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
